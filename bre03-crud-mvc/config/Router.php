<?php
class Router
{
    public function route()
    {
        $route = isset($_GET['route']) ? $_GET['route'] : 'default';
        $userController = new UserController();

        switch ($route) {
            case 'show_user':
                $userController->show();
                break;
            case 'create_user':
                $userController->create();
                break;
            case 'check_create_user':
                $userController->checkCreate();
                break;
            case 'update_user':
                $userController->update();
                break;
            case 'check_update_user':
                $userController->checkUpdate();
                break;
            case 'delete_user':
                $userController->delete();
                break;
            default:
                $userController->list();
                break;
        }
    }
}
