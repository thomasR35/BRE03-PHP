<?php

require_once __DIR__ . '/../managers/UserManager.class.php';

try {
    $userManager = new UserManager();

    $userManager->loadUsers();

    $users = $userManager->getUsers();

    foreach ($users as $user) {
        echo "
        ID: {$user->getId()}, 
        Username: {$user->getUsername()}, 
        Email: {$user->getEmail()}, 
        Role: {$user->getRole()}<br>";
    }
} catch (Exception $e) {
    echo "Une erreur est survenue : " . $e->getMessage();
}


