<?php
// managers/AbstractManager.php

abstract class AbstractManager
{
    protected $db;

    public function __construct()
    {
        // Informations de connexion à la base de données à partir des variables d'environnement
        $host = getenv('DB_HOST');
        $dbname = getenv('DB_NAME');
        $username = getenv('DB_USER');
        $password = getenv('DB_PASS');

        // Chaîne de connexion DSN
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

        try {
            // Création de l'instance PDO
            $this->db = new PDO($dsn, $username, $password);
            // Configuration des options de PDO
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Gérer les erreurs de connexion
            echo 'Erreur de connexion : ' . $e->getMessage();
        }
    }
}
