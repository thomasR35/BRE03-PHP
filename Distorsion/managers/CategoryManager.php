<?php

namespace Managers;

use Config\Database;
use Models\Category;
use PDO;

class CategoryManager
{
    /**
     * Récupère toutes les catégories
     *
     * @return Category[]
     */
    public function findAll(): array
    {
        $pdo = Database::getConnection();
        $query = $pdo->query('SELECT * FROM categories ORDER BY created_at DESC');

        $categories = [];
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $categories[] = new Category(
                $row['id'],
                $row['name'],
                $row['created_at']
            );
        }

        return $categories;
    }

    /**
     * Récupère une catégorie par son id
     *
     * @param int $id
     * @return Category|null
     */
    public function find(int $id): ?Category
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('SELECT * FROM categories WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Category(
                $row['id'],
                $row['name'],
                $row['created_at']
            );
        }

        return null;
    }

    /**
     * Insère une nouvelle catégorie en base
     *
     * @param Category $category
     * @return int Retourne l'ID de la nouvelle catégorie
     */
    public function insert(Category $category): int
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('INSERT INTO categories (name) VALUES (:name)');
        $stmt->execute([
            'name' => $category->getName()
        ]);

        return (int) $pdo->lastInsertId();
    }

    /**
     * Met à jour une catégorie existante
     *
     * @param Category $category
     * @return bool
     */
    public function update(Category $category): bool
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('UPDATE categories SET name = :name WHERE id = :id');
        return $stmt->execute([
            'name' => $category->getName(),
            'id'   => $category->getId()
        ]);
    }

    /**
     * Supprime une catégorie
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('DELETE FROM categories WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}
