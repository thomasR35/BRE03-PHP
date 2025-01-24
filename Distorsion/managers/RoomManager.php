<?php

namespace Managers;

use Config\Database;
use Models\Room;
use PDO;

class RoomManager
{
    /**
     * Récupère tous les salons (rooms).
     *
     * @return Room[]
     */
    public function findAll(): array
    {
        $pdo = Database::getConnection();
        $query = $pdo->query('SELECT * FROM rooms ORDER BY created_at DESC');

        $rooms = [];
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $rooms[] = new Room(
                $row['id'],
                $row['category_id'],
                $row['name'],
                $row['created_at']
            );
        }

        return $rooms;
    }

    /**
     * Récupère tous les salons pour une catégorie précise.
     *
     * @param int $categoryId
     * @return Room[]
     */
    public function findAllByCategory(int $categoryId): array
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('SELECT * FROM rooms WHERE category_id = :catId ORDER BY created_at DESC');
        $stmt->execute(['catId' => $categoryId]);

        $rooms = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $rooms[] = new Room(
                $row['id'],
                $row['category_id'],
                $row['name'],
                $row['created_at']
            );
        }

        return $rooms;
    }

    /**
     * Récupère un salon par son ID.
     *
     * @param int $id
     * @return Room|null
     */
    public function find(int $id): ?Room
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('SELECT * FROM rooms WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Room(
                $row['id'],
                $row['category_id'],
                $row['name'],
                $row['created_at']
            );
        }

        return null;
    }

    /**
     * Insère un nouveau salon dans la BDD.
     *
     * @param Room $room
     * @return int
     */
    public function insert(Room $room): int
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('INSERT INTO rooms (category_id, name) VALUES (:category_id, :name)');
        $stmt->execute([
            'category_id' => $room->getCategoryId(),
            'name'        => $room->getName()
        ]);

        return (int) $pdo->lastInsertId();
    }

    /**
     * Met à jour un salon.
     *
     * @param Room $room
     * @return bool
     */
    public function update(Room $room): bool
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('UPDATE rooms SET category_id = :category_id, name = :name WHERE id = :id');
        return $stmt->execute([
            'category_id' => $room->getCategoryId(),
            'name'        => $room->getName(),
            'id'          => $room->getId()
        ]);
    }

    /**
     * Supprime un salon.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('DELETE FROM rooms WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}
