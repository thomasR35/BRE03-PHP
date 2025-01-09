<?php

$host = "db.3wa.io";
$port = "3306";
$dbname = "thomasriou_php_j6";
$connexionString = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";

$user = "thomasriou";
$password = "e11d02ae58dcb7466cf6407c21138658";

try {
    
    $db = new PDO(
        $connexionString,
        $user,
        $password
    );

    
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    
    die("La connexion a échoué : " . $e->getMessage());
}
?>
