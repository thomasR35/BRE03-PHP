<?php
require_once __DIR__ . '/config/autoload.php';
require_once __DIR__ . '/config/Router.php';

$router = new Router();
$router->handleRequest();
