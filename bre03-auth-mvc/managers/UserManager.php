<?php
require_once 'models/User.php';

class UserManager extends AbstractManager
{
    public function createUser(string $email, string $password): void
    {
        $query = $this->pdo->prepare('INSERT INTO users (email, password) VALUES (:email, :password)');
        $query->execute(['email' => $email, 'password' => $password]);
    }
    public function findUserByEmail(string $email): ?User
    {
        $query = $this->pdo->prepare('SELECT * FROM users WHERE email = :email');
        $query->execute(['email' => $email]);
        $data = $query->fetch();

        return $data ? new User($data) : null;
    }
}
