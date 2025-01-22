<?php

$dsn = 'mysql:host=db.3wa.io;dbname=thomasriou_userbase_poo';
$username = 'thomasriou';
$password = 'e11d02ae58dcb7466cf6407c21138658';

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
