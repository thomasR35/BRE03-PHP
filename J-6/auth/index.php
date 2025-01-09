<?php
session_start();

require 'connexion.php';

$route = isset($_GET['route']) ? $_GET['route'] : NULL;

require 'layout.phtml';
?>
