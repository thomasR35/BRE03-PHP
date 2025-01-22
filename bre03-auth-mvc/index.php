<?php
require_once 'config/autoload.php';
require_once 'config/Router.php';
require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

session_start();

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$dbHost = $_ENV['DB_HOST'];
$dbName = $_ENV['DB_NAME'];
$dbUser = $_ENV['DB_USER'];
$dbPassword = $_ENV['DB_PASSWORD'];

try {
    $dsn = "mysql:host=$dbHost;dbname=$dbName";
    $pdo = new PDO($dsn, $dbUser, $dbPassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

if (isset($_GET['message']) && $_GET['message'] === 'deconnexion') {
    echo '<p style="color: green; font-weight: bold;">Déconnexion réussie !</p>';
} elseif (isset($_SESSION['user'])) {
    echo '<p style="color: green; font-weight: bold;">Connexion réussie !</p>';
} else {
}
$router = new Router();
$router->handleRequest($_GET);
