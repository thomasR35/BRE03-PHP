<?php
require_once __DIR__ . '/../managers/UserManager.class.php';
require_once __DIR__ . '/../models/User.class.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['role'])) {
        
        $user = new User(
            $_POST['username'], 
            $_POST['email'], 
            $_POST['password'], 
            $_POST['role']
        );

        $userManager = new UserManager();
        $userManager->saveUser($user);

        echo "Utilisateur enregistré avec succès.";

    } else {
        echo "Veuillez remplir tous les champs.";
    }

    header('Location: ../index.php');
    exit;
}

