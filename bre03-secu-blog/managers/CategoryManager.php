<?php

/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */

require_once 'AbstractManager.php';
require_once 'Category.php';

class CategoryManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    }

    // Retourne toutes les catégories
    public function findAll(): array
    {
        $query = $this->db->query("SELECT id, title, description FROM categories");
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        $categories = [];
        foreach ($results as $result) {
            $categories[] = new Category($result['id'], $result['title'], $result['description']);
        }

        return $categories;
    }

    // Retourne une catégorie par son ID
    public function findOne(int $id): ?Category
    {
        $query = $this->db->prepare("SELECT id, title, description FROM categories WHERE id = :id");
        $query->execute(['id' => $id]);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new Category($result['id'], $result['title'], $result['description']);
        }

        return null;
    }
}
