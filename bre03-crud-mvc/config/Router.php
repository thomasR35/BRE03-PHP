<?php
// config/Router.php

class Router
{
    public function route($uri, $method)
    {
        $userController = new UserController();

        switch ($uri) {
            case '/users':
                if ($method === 'GET') {
                    $userController->listUsers();
                }
                break;
            case '/users/create':
                if ($method === 'POST') {
                    $userData = $_POST;
                    $userController->createUser($userData);
                }
                break;
            case '/users/update':
                if ($method === 'POST') {
                    $id = $_POST['id'];
                    $userData = $_POST;
                    $userController->updateUser($id, $userData);
                }
                break;
            case '/users/delete':
                if ($method === 'POST') {
                    $id = $_POST['id'];
                    $userController->deleteUser($id);
                }
                break;
            default:
                echo 'Page not found';
                break;
        }
    }
}
