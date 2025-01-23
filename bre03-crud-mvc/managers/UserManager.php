<?php
// managers/UserManager.php

require_once 'AbstractManager.php';

class UserManager extends AbstractManager
{
    public function getAllUsers()
    {
        $query = "SELECT * FROM users";
        $statement = $this->db->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getUserById($id)
    {
        $query = "SELECT * FROM users WHERE id = :id";
        $statement = $this->db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetch();
    }

    public function addUser($userData)
    {
        $query = "INSERT INTO users (name, email) VALUES (:name, :email)";
        $statement = $this->db->prepare($query);
        $statement->bindValue(':name', $userData['name'], PDO::PARAM_STR);
        $statement->bindValue(':email', $userData['email'], PDO::PARAM_STR);
        return $statement->execute();
    }

    public function updateUser($id, $userData)
    {
        $query = "UPDATE users SET name = :name, email = :email WHERE id = :id";
        $statement = $this->db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->bindValue(':name', $userData['name'], PDO::PARAM_STR);
        $statement->bindValue(':email', $userData['email'], PDO::PARAM_STR);
        return $statement->execute();
    }

    public function deleteUser($id)
    {
        $query = "DELETE FROM users WHERE id = :id";
        $statement = $this->db->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        return $statement->execute();
    }
}
