<?php
require_once 'config/autoload.php';
require_once 'config/Router.php';
require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

session_start();

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new Router();
$router->handleRequest($_GET);

if (isset($_GET['message']) && $_GET['message'] === 'deconnexion') {
    echo '<p style="color: green; font-weight: bold;">Déconnexion réussie !</p>';
} elseif (isset($_SESSION['user'])) {
    echo '<p style="color: green; font-weight: bold;">Connexion réussie !</p>';
} else {
}
