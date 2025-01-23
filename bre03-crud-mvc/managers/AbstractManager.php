<?php
abstract class AbstractManager
{
    protected PDO $db;

    public function __construct()
    {
        $dsn = 'mysql:host=localhost;dbname=crud_mvc;charset=utf8';
        $username = 'root';
        $password = '';
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            $this->db = new PDO($dsn, $username, $password, $options);
        } catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
            exit;
        }
    }
}
