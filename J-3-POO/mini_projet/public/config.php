<?php

$host = "localhost"; // Remplacez par votre hôte de base de données
$dbname = "thomasriou_blog_poo"; // Remplacez par votre nom de base de données
$user = "thomasriou"; // Remplacez par votre nom d'utilisateur
$password = "e11d02ae58dcb7466cf6407c21138658"; // Remplacez par votre mot de passe

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die("Échec de la connexion à la base de données : " . $e->getMessage());
}
