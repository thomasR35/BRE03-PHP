<?php

/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */

class AuthController extends AbstractController
{
    private UserManager $userManager;

    public function __construct()
    {
        $this->userManager = new UserManager();
    }

    public function login(): void
    {
        $csrfTokenManager = new CSRFTokenManager();
        $csrfToken = $csrfTokenManager->generateCSRFToken();

        // Stocker le token dans la session pour validation ultérieure
        $_SESSION['csrf_token'] = $csrfToken;

        $this->render("login", ['csrf_token' => $csrfToken]);
    }

    public function checkLogin(): void
    {
        // Récupérer les données du formulaire
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;
        $csrfTokenManager = new CSRFTokenManager();

        // Valider le token CSRF
        if (empty($_POST['csrf-token']) || !$csrfTokenManager->validateCSRFToken($_POST['csrf-token'])) {
            $this->redirect("index.php?route=login&error=csrf");
            return;
        }
        // Validation des données
        if (empty($email) || empty($password)) {
            $this->redirect("index.php?route=login&error=missing_fields");
            return;
        }

        // Rechercher l'utilisateur par email
        $user = $this->userManager->findByEmail($email);

        if ($user && password_verify($password, $user->getPassword())) {
            // Initialiser la session utilisateur
            $_SESSION['user'] = [
                'id' => $user->getId(),
                'username' => $user->getUsername(),
                'email' => $user->getEmail(),
                'role' => $user->getRole(),
            ];

            // Rediriger vers la page d'accueil
            $this->redirect("index.php");
        } else {
            // Rediriger vers la page de login avec un message d'erreur
            $this->redirect("index.php?route=login&error=invalid_credentials");
        }
    }

    public function register(): void
    {
        $csrfTokenManager = new CSRFTokenManager();
        $csrfToken = $csrfTokenManager->generateCSRFToken();

        // Stocker le token dans la session
        $_SESSION['csrf_token'] = $csrfToken;

        $this->render("register", ['csrf_token' => $csrfToken]);
    }

    public function checkRegister(): void
    {
        // Récupérer les données du formulaire
        $username = htmlspecialchars($_POST['username'] ?? null);
        $email = htmlspecialchars($_POST['email'] ?? null);
        $password = htmlspecialchars($_POST['password'] ?? null);
        $confirmPassword = htmlspecialchars($_POST['confirm_password'] ?? null);
        $csrfTokenManager = new CSRFTokenManager();

        // Valider le token CSRF
        if (empty($_POST['csrf-token']) || !$csrfTokenManager->validateCSRFToken($_POST['csrf-token'])) {
            $this->redirect("index.php?route=login&error=csrf");
            return;
        }
        // Validation des données
        if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
            $this->redirect("index.php?route=register&error=missing_fields");
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->redirect("index.php?route=register&error=invalid_email");
            return;
        }

        if ($password !== $confirmPassword) {
            $this->redirect("index.php?route=register&error=password_mismatch");
            return;
        }

        // Validation de la force du mot de passe
        if (!preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password)) {
            $this->redirect("index.php?route=register&error=weak_password");
            return;
        }

        // Vérifier si l'utilisateur existe déjà
        if ($this->userManager->findByEmail($email)) {
            $this->redirect("index.php?route=register&error=user_exists");
            return;
        }

        // Créer et enregistrer l'utilisateur
        $user = (new User())
            ->setUsername($username)
            ->setEmail($email)
            ->setPassword($password) // Le hash est géré dans UserManager
            ->setRole('user') // Par défaut, les utilisateurs sont de rôle "user"
            ->setCreatedAt(new DateTime());

        $this->userManager->create($user);

        // Initialiser la session utilisateur
        $_SESSION['user'] = [
            'id' => $user->getId(),
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'role' => $user->getRole(),
        ];

        // Rediriger vers la page d'accueil
        $this->redirect("index.php");
    }

    public function logout(): void
    {
        // Détruire la session
        session_destroy();

        // Rediriger vers la page d'accueil
        $this->redirect("index.php");
    }
}
