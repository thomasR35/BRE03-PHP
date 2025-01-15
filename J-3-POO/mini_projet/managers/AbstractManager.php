<?php

namespace mini_projet\managers;

use PDO;

require_once __DIR__ . '/../public/config.php';

abstract class AbstractManager
{
    protected PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
}
