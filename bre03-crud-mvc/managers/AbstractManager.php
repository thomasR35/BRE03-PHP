<?php

abstract class AbstractManager
{
    protected $db;

    public function __construct()
    {

        $host = getenv('DB_HOST');
        $dbname = getenv('DB_NAME');
        $port = getenv('DB_PORT');
        $username = getenv('DB_USER');
        $password = getenv('DB_PASSWORD');
        $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";

        try {
            $this->db = new PDO($dsn, $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Erreur de connexion : ' . $e->getMessage();
        }
    }
}
