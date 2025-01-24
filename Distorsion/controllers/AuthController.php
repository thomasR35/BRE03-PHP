<?php

namespace Controllers;

use Managers\UserManager;
use Models\User;

class AuthController extends BaseController
{
    private UserManager $userManager;

    public function __construct()
    {
        parent::__construct();
        $this->userManager = new UserManager();
        session_start(); // Démarrage de la session
    }

    /**
     * Affiche le formulaire de connexion
     */
    public function loginForm(): void
    {
        $this->render('auth/login');
    }

    /**
     * Traite le formulaire de connexion
     */
    public function login(): void
    {
        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->userManager->findByUsername($username);
            if ($user) {
                // Vérification du mot de passe
                if (password_verify($password, $user->getPassword())) {
                    // OK : on stocke en session
                    $_SESSION['user_id'] = $user->getId();
                    $_SESSION['role'] = $user->getRole();

                    header('Location: index.php?route=/');
                    exit;
                }
            }
            // En cas d'erreur
            $this->render('auth/login', [
                'error' => 'Identifiants incorrects.'
            ]);
        } else {
            $this->render('auth/login', [
                'error' => 'Veuillez remplir tous les champs.'
            ]);
        }
    }

    /**
     * Déconnexion
     */
    public function logout(): void
    {
        session_start();
        session_destroy();
        header('Location: index.php?route=/');
        exit;
    }

    /**
     * Formulaire d'inscription (optionnel)
     */
    public function registerForm(): void
    {
        $this->render('auth/register');
    }

    /**
     * Traite le formulaire d'inscription (optionnel)
     */
    public function register(): void
    {
        if (!empty($_POST['username']) && !empty($_POST['password'])) {
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $user = new User();
            $user->setUsername($username);
            $user->setPassword($password);
            $user->setRole('user'); // ou 'admin' si besoin

            $this->userManager->insert($user);

            // Redirection vers la connexion
            header('Location: index.php?route=/login');
            exit;
        } else {
            $this->render('auth/register', [
                'error' => 'Tous les champs sont requis.'
            ]);
        }
    }
}
