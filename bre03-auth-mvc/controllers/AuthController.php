<?php
require_once 'managers/UserManager.php';

class AuthController
{
    public function showConnexionForm(): void
    {
        $route = 'connexion';
        require 'templates/layout.phtml';
    }

    public function handleConnexion(): void
    {
        $userManager = new UserManager();
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $userManager->findUserByEmail($email);
        if ($user && password_verify($password, $user->getPassword())) {
            $_SESSION['user'] = $user->getId();
            header('Location: index.php?route=espace-perso');
        } else {
            echo "Identifiants incorrects";
        }
    }

    public function showInscriptionForm(): void
    {
        $route = 'inscription';
        require 'templates/layout.phtml';
    }

    public function handleInscription(): void
    {
        $userManager = new UserManager();
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $userManager->createUser($email, $password);
        header('Location: index.php?route=connexion');
    }
    public function handleLogout(): void
    {
        session_start();
        session_unset();
        session_destroy();

        header('Location: index.php?route=connexion&message=deconnexion');
        exit();
    }
}
