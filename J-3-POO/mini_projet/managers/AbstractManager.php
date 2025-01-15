<?php

namespace mini_projet\managers;

use PDO;

abstract class AbstractManager
{
    protected PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
}
