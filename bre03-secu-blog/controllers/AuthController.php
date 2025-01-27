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
        // Générer un token CSRF s'il n'existe pas
        if (!isset($_SESSION['csrf_token'])) {
            $csrfTokenManager = new CSRFTokenManager();
            $_SESSION['csrf_token'] = $csrfTokenManager->generateCSRFToken();
        }

        // Afficher la vue en passant le token
        $this->render("login", ['csrf_token' => $_SESSION['csrf_token']]);
    }


    public function checkLogin(): void
    {
        // Récupérer les données du formulaire
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;
        $csrfTokenManager = new CSRFTokenManager();

        // Valider le token CSRF
        if (!isset($_SESSION['csrf_token']) || !$csrfTokenManager->validateCSRFToken($_POST['csrf-token'])) {
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
        } elseif (!$user || !password_verify($password, $user->getPassword())) {
            $_SESSION['login_error'] = "Invalid credentials";
            $this->redirect("index.php?route=login");
            return;
        }
    }

    public function register(): void
    {
        // Récupérer le token CSRF depuis la session
        $csrfToken = $_SESSION['csrf_token'] ?? null;

        // Afficher la vue en passant le token
        $this->render("register", ['csrf_token' => $csrfToken]);
    }

    public function checkRegister(): void
    {
        // Récupérer les données du formulaire
        $username = $_POST['username'] ?? null;
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;
        $confirmPassword = $_POST['confirm_password'] ?? null;
        $csrfTokenManager = new CSRFTokenManager();

        // Valider le token CSRF
        if (empty($_POST['csrf-token']) || !$csrfTokenManager->validateCSRFToken($_POST['csrf-token'])) {
            $this->redirect("index.php?route=login&error=csrf");
            return;
        }
        if (!isset($_SESSION['csrf_token'])) {
            $this->redirect("index.php?route=login&error=session_expired");
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
            ->setPassword(password_hash($password, PASSWORD_BCRYPT))
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
        // Effacer toutes les variables de session
        $_SESSION = [];

        // Détruire la session
        session_destroy();

        // Rediriger vers la page d'accueil
        $this->redirect("index.php");
    }
}
