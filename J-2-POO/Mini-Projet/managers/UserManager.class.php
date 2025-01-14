<?php

require __DIR__ . '/../models/User.class.php';

class UserManager
{
    private array $users = [];
    private PDO $db;

    public function __construct()
    {
        $host = "db.3wa.io";
        $port = "3306";
        $dbname = "thomasriou_userbase_poo";
        $connexionString = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";

        $user = "thomasriou";
        $password = "e11d02ae58dcb7466cf6407c21138658";

        $this->db = new PDO(
            $connexionString,
            $user,
            $password
        );
    }

    public function getUsers(): array
    {
        return $this->users;
    }

    public function setUsers(array $users): void
    {
        $this->users = $users;
    }

    public function loadUsers() : void
    {
        $query = $this->db->prepare('SELECT * FROM users');
        $parameters = [

        ];
        $query->execute($parameters);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        $users = [];

        foreach($result as $item)
        {
            $user = new User($item["username"], $item["email"], $item["password"], $item["role"]);
            $user->setId($item["id"]);

            $users[] = $user;
        }

        $this->setUsers($users);
    }

    public function saveUser(User$user) : void
    {
        $query = $this->db->prepare('INSERT INTO users (id, username, email, password, role, created_at) VALUES(NULL, :username, :email, :password, :role, NOW())');
        $parameters = [
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'role' => $user->getRole()
        ];
        $query->execute($parameters);

        $user->setId($this->db->lastInsertId());
    }

    public function deleteUser(User $user) : void
    {
        $query = $this->db->prepare('DELETE FROM users WHERE id=:id');
        $parameters = [
            "id" => $user->getId()
        ];
        $query->execute($parameters);
    }
    
}

