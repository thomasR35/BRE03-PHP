<?php
// config/autoload.php

require_once __DIR__ . '/../vendor/autoload.php'; // Charger l'autoloader de Composer

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

// Requérir les fichiers nécessaires
require_once __DIR__ . '/../managers/AbstractManager.php';
require_once __DIR__ . '/../managers/UserManager.php';
require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/Router.php';
