<?php

require_once __DIR__ . '/../config/autoload.php';

use Routes\Router;
use Controllers\PageController;
use Controllers\CategoryController;
use Controllers\RoomController;
use Controllers\MessageController;
use Controllers\AuthController;

$router = new Router();

// Routes Pages
$router->add('/', [PageController::class, 'home']);
$router->add('/about', [PageController::class, 'about']);

// Routes Catégories
$router->add('/categories', [CategoryController::class, 'listCategories']);
$router->add('/categories/create', [CategoryController::class, 'createCategory']);
$router->add('/categories/store', [CategoryController::class, 'storeCategory']);
$router->add('/categories/edit', [CategoryController::class, 'editCategory']);
$router->add('/categories/update', [CategoryController::class, 'updateCategory']);
$router->add('/categories/delete', [CategoryController::class, 'deleteCategory']);

// Routes Salles
$router->add('/rooms', [RoomController::class, 'listRooms']);
$router->add('/rooms/create', [RoomController::class, 'createRoom']);
$router->add('/rooms/store', [RoomController::class, 'storeRoom']);
$router->add('/rooms/edit', [RoomController::class, 'editRoom']);
$router->add('/rooms/update', [RoomController::class, 'updateRoom']);
$router->add('/rooms/delete', [RoomController::class, 'deleteRoom']);

// Optionnel : liste des salons pour une catégorie précise
$router->add('/rooms/by-category', [RoomController::class, 'listRoomsByCategory']);

// Routes pour les messages
$router->add('/messages/list', [MessageController::class, 'listMessages']);
$router->add('/messages/store', [MessageController::class, 'storeMessage']);
$router->add('/messages/delete', [MessageController::class, 'deleteMessage']);

// Routes d'authentification
$router->add('/login-form', [AuthController::class, 'loginForm']);
$router->add('/login', [AuthController::class, 'login']);
$router->add('/logout', [AuthController::class, 'logout']);
$router->add('/register-form', [AuthController::class, 'registerForm']);
$router->add('/register', [AuthController::class, 'register']);


// Optionnel pour l'inscription
$router->add('/register-form', [AuthController::class, 'registerForm']);
$router->add('/register', [AuthController::class, 'register']);

// Gestion des erreurs 404
$router->handle();
