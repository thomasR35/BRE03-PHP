<?php

require_once __DIR__ . '/vendor/autoload.php';

require 'User.php';
require 'connexion.php';

$superman = [
    "first_name" => "Clark",
    "last_name" => "Kent",
    "email" => "clark.kent@test.fr"
];

$user = new User($superman['first_name'], $superman['last_name'], $superman['email']);
echo "User créé : {$user->getFirstName()} {$user->getLastName()} ({$user->getEmail()})<br><br>";


$connexion = new Connexion();
$db = $connexion->getPDO();

$query = $db->query("SELECT * FROM users LIMIT 1");
$row = $query->fetch(PDO::FETCH_ASSOC);

if ($row) {
    $user = new User($row['first_name'], $row['last_name'], $row['email'], $row['id']);
    echo "User trouvé : {$user->getFirstName()} {$user->getLastName()} ({$user->getEmail()})<br><br>";
}

$query = $db->query("SELECT * FROM users");
$dbUsers = $query->fetchAll(PDO::FETCH_ASSOC);
$users = [];

foreach ($dbUsers as $dbUser) {
    $user = new User($dbUser['first_name'], $dbUser['last_name'], $dbUser['email']);
    $users[] = $user;
    echo "User : {$user->getFirstName()} {$user->getLastName()} ({$user->getEmail()})<br>";
}

$newUser = new User('Clark', 'Kent', 'clark.kent@test.fr');

$query = $db->prepare("INSERT INTO users (first_name, last_name, email) VALUES (:first_name, :last_name, :email)");
$query->execute([
    'first_name' => $newUser->getFirstName(),
    'last_name' => $newUser->getLastName(),
    'email' => $newUser->getEmail()
]);

$newUserId = $db->lastInsertId();
$newUser->setId((int)$newUserId);

echo "Nouveau User ajouté : {$newUser->getFirstName()} {$newUser->getLastName()} ({$newUser->getEmail()})<br><br>";
?>

