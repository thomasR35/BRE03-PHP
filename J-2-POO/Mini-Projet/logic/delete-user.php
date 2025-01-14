<?php
require_once '..managers/UserManager.php';
require_once '..models/User.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $userManager = new UserManager();
    $userManager->loadUsers();
 
    $users = $userManager->getUsers();
    foreach ($users as $user) {
        if ($user->getId() == $userId) {
            $userMnager->deleteUser($user);
            break;
        }
    }
    header('Location: ../templates/user-list.phtml');
    exit;
}



