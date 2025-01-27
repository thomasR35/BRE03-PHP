<?php

/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */

class CategoryManager extends AbstractManager
{
    public function findAll(): array
    {
        $query = $this->db->query('SELECT * FROM categories');
        $categories = [];
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $categories[] = (new Category())
                ->setId((int)$row['id'])
                ->setTitle($row['title'])
                ->setDescription($row['description']);
        }
        return $categories;
    }

    public function findOne(int $id): ?Category
    {
        $query = $this->db->prepare('SELECT * FROM categories WHERE id = :id');
        $query->execute(['id' => $id]);
        $row = $query->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return (new Category())
                ->setId((int)$row['id'])
                ->setTitle($row['title'])
                ->setDescription($row['description']);
        }
        return null;
    }
}
