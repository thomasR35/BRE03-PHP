<?php
// config/database.php
$dsn = 'mysql:host=localhost;dbname=userbase_poo';
$username = 'root'; // ou votre utilisateur
$password = ''; // ou votre mot de passe

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
