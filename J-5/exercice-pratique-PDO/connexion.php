<?php
$host = "db.3wa.io";
$port = "3306";
$dbname = "thomasriou_phpj5";
$connexionString = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";

$user = "thomasriou";
$password = "e11d02ae58dcb7466cf6407c21138658";

$db = new PDO(
    $connexionString,
    $user,
    $password
);

var_dump($db);
?>