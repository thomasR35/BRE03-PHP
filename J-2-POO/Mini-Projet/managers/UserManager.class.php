<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../models/User.class.php';
use Dotenv\Dotenv;

class UserManager {

    private array $users = [];
    private PDO $db;

    public function __construct() {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();

        $host = $_ENV['DB_HOST'];
        $port = $_ENV['DB_PORT'];
        $dbname = $_ENV['DB_NAME'];
        $username = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASSWORD'];

        $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";

        try {
            $this->db = new PDO($dsn, $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }
    public function getUsers(): array {
        return $this->users;
    }

    public function setUsers(array $users): void {
        $this->users = $users;
    }

    public function loadUsers(): void {
        $query = $this->db->query("SELECT * FROM users");
        $dbusers = $query->fetchAll(PDO::FETCH_ASSOC);

        $users = [];
        foreach ($dbusers as $dbuser) {
            $user = new User(
                $dbuser['username'], 
                $dbuser['email'], 
                $dbuser['password'], 
                $dbuser['role']
            );
            $user->setId($dbuser['id']);
            $users[] = $user;
        }

        $this->setUsers($users);
    }

    public function saveUser(User $user): void {
        $query = $this->db->prepare("INSERT INTO users (username, email, password, role, created_at) VALUES (:username, :email, :password, :role, NOW())");
        $hashedPassword = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        $query->execute([
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $hashedPassword,
            'role' => $user->getRole()
        ]);
    }

    public function deleteUser(User $user): void {
        $query = $this->db->prepare("DELETE FROM users WHERE id = :id");
        $query->execute([
            'id' => $user->getId()
        ]);
    }
}

