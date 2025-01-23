<?php
abstract class AbstractManager
{
    protected $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=prenomnom_crud_mvc;charset=utf8', 'root', '');
    }
}
