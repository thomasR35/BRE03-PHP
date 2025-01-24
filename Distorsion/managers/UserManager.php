<?php

namespace Managers;

use Config\Database;
use Models\User;
use PDO;

class UserManager
{
    /**
     * Recherche un utilisateur par son username
     */
    public function findByUsername(string $username): ?User
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->execute(['username' => $username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new User(
                $row['id'],
                $row['username'],
                $row['password'],
                $row['role']
            );
        }

        return null;
    }

    /**
     * Insère un nouvel utilisateur (pour l'inscription éventuelle)
     */
    public function insert(User $user): int
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('INSERT INTO users (username, password, role) VALUES (:username, :password, :role)');
        $stmt->execute([
            'username' => $user->getUsername(),
            'password' => $user->getPassword(),
            'role'     => $user->getRole()
        ]);

        return (int) $pdo->lastInsertId();
    }

    /**
     * Récupère un utilisateur par son ID
     */
    public function find(int $id): ?User
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new User(
                $row['id'],
                $row['username'],
                $row['password'],
                $row['role']
            );
        }

        return null;
    }
}
