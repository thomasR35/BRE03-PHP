<?php

namespace mini_projet\Managers;

use PDO;

abstract class AbstractManager
{
    protected PDO $db;

    public function __construct()
    {
        $this->db = new PDO("mysql:host=localhost;dbname=your_database", "username", "password", [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }
}
