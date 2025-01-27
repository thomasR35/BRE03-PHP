<?php

/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */
require_once __DIR__ . '/../managers/UserManager.php';
require_once __DIR__ . '/../services/Security.php';

class AuthController extends AbstractController
{
    private UserManager $userManager;

    public function __construct()
    {
        $this->userManager = new UserManager();
    }

    /**
     * Affiche le formulaire de connexion
     */
    public function login(): void
    {
        $csrfToken = generateCsrfToken();
        $this->render("login", ["csrf_token" => $csrfToken]);
    }

    /**
     * Vérifie les informations de connexion
     */
    public function checkLogin(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Vérification du token CSRF
            if (!verifyCsrfToken()) {
                die('Erreur CSRF : opération non autorisée.');
            }

            // Récupération et nettoyage des données
            $email = sanitize($_POST['email'] ?? '');
            $password = $_POST['password'] ?? ''; // Pas besoin de sanitize les mots de passe

            // Recherche de l'utilisateur par email
            $user = $this->userManager->findByEmail($email);

            if ($user && password_verify($password, $user->password)) {
                // Mot de passe valide, on démarre une session
                session_start();
                $_SESSION['user_id'] = $user->id;
                $_SESSION['username'] = $user->username;

                // Redirige vers la page d'accueil
                $this->redirect("index.php");
            } else {
                // Identifiants invalides, redirige vers la page de connexion
                $this->redirect("index.php?route=login&error=1");
            }
        }
    }

    /**
     * Affiche le formulaire d'inscription
     */
    public function register(): void
    {
        $csrfToken = generateCsrfToken();
        $this->render("register", ["csrf_token" => $csrfToken]);
    }

    /**
     * Vérifie les informations d'inscription et crée un nouvel utilisateur
     */
    public function checkRegister(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Vérification du token CSRF
            if (!verifyCsrfToken()) {
                die('Erreur CSRF : opération non autorisée.');
            }

            // Récupération et nettoyage des données
            $username = sanitize($_POST['username'] ?? '');
            $email = sanitize($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            // Validation du mot de passe
            if (!validatePassword($password)) {
                $this->redirect("index.php?route=register&error=weak_password");
            }

            // Vérifie si l'utilisateur existe déjà
            $existingUser = $this->userManager->findByEmail($email);
            if ($existingUser) {
                $this->redirect("index.php?route=register&error=user_exists");
            }

            // Hachage du mot de passe
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Création de l'utilisateur
            $user = new User(null, $username, $email, $hashedPassword, 'user', new DateTime());
            $this->userManager->create($user);

            // Connecte l'utilisateur directement après l'inscription
            session_start();
            $_SESSION['user_id'] = $user->id;
            $_SESSION['username'] = $user->username;

            // Redirige vers la page d'accueil
            $this->redirect("index.php");
        }
    }

    /**
     * Déconnecte l'utilisateur
     */
    public function logout(): void
    {
        session_start();
        session_destroy();

        $this->redirect("index.php");
    }
}
