<?php

namespace mini_projet\Managers;

use mini_projet\Models\User;
use PDO;

class UserManager extends AbstractManager
{
    public function findAll(): array
    {
        $stmt = $this->db->query("SELECT * FROM users");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $users = [];
        foreach ($results as $row) {
            $user = new User($row['name'], $row['email'], $row['password'], $row['created_at']);
            $user->setId($row['id']);
            $users[] = $user;
        }

        return $users;
    }

    public function findOne(int $id): ?User
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $user = new User($row['name'], $row['email'], $row['password'], $row['created_at']);
            $user->setId($row['id']);
            return $user;
        }

        return null;
    }

    public function create(User $user): void
    {
        $stmt = $this->db->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
        $stmt->execute([$user->getUsername(), $user->getEmail()]);
    }

    public function update(User $user): void
    {
        $stmt = $this->db->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
        $stmt->execute([$user->getUsername(), $user->getEmail(), $user->getId()]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
    }
}
