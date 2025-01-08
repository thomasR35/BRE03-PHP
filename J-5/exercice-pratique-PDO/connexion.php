<?php
$host = "db.3wa.io";
$port = "3306";
$dbname = "thomasriou_phpj5";
$connexionString = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";

$user = "votre_username";
$password = "votre_password";

$db = new PDO(
    $connexionString,
    $user,
    $password
);

var_dump($db);
?>