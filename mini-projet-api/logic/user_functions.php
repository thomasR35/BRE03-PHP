<?php
require_once 'config/database.php';
require_once 'models/User.php';

function getAllUsers(): array
{
    global $pdo;
    $stmt = $pdo->query('SELECT * FROM users');
    $users = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $users[] = new User($row['username'], $row['email'], $row['password'], $row['role'], $row['id']);
    }
    return $users;
}

function getUserById(int $id): ?User
{
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        return new User($row['username'], $row['email'], $row['password'], $row['role'], $row['id']);
    }
    return null;
}
