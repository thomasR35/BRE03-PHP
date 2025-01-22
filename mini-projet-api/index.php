<?php
require_once 'config/database.php';
require_once 'models/User.php';
require_once 'logic/user_functions.php';

header('Content-Type: application/json');

if (isset($_GET['route'])) {
    switch ($_GET['route']) {
        case 'get_all_users':
            $users = getAllUsers();
            $data = [];
            foreach ($users as $user) {
                $data[] = $user->toArray();
            }
            echo json_encode($data);
            break;

        case 'get_user_by_id':
            if (isset($_GET['id']) && !empty($_GET['id'])) {
                $user = getUserById((int)$_GET['id']);
                if ($user) {
                    echo json_encode($user->toArray());
                } else {
                    echo json_encode(['error' => 'User not found']);
                }
            }
            break;

        default:
            echo json_encode(['error' => 'Invalid route']);
            break;
    }
}
