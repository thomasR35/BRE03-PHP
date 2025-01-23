<?php
// controllers/UserController.php

require_once __DIR__ . '/../managers/UserManager.php';

class UserController
{
    private $userManager;

    public function __construct()
    {
        $this->userManager = new UserManager();
    }

    public function listUsers()
    {
        $users = $this->userManager->getAllUsers();
        require __DIR__ . '/../templates/users/list.phtml';
    }

    public function showUser($id)
    {
        $user = $this->userManager->getUserById($id);
        require __DIR__ . '/../templates/users/show.phtml';
    }

    public function createUser($userData)
    {
        $this->userManager->addUser($userData);
        header('Location: /users');
    }

    public function updateUser($id, $userData)
    {
        $this->userManager->updateUser($id, $userData);
        header('Location: /users');
    }

    public function deleteUser($id)
    {
        $this->userManager->deleteUser($id);
        header('Location: /users');
    }
}
