<?php

/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */

session_start();

require_once __DIR__ . '/config/autoload.php';

$router = new Router();

$router->handleRequest($_GET);
