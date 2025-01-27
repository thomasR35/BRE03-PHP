<?php

/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */

session_start();

// Charger l'autoloader
require_once __DIR__ . '/config/autoload.php';

// Gérer le token CSRF dès le chargement
if (!isset($_SESSION['csrf_token'])) {
    $csrfTokenManager = new CSRFTokenManager();
    $_SESSION['csrf_token'] = $csrfTokenManager->generateCSRFToken();
}

// Initialiser le routeur
$router = new Router();
$router->handleRequest($_GET);
