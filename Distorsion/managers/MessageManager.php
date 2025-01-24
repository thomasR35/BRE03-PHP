<?php

namespace Managers;

use Config\Database;
use Models\Message;
use PDO;

class MessageManager
{
    /**
     * Récupère tous les messages d'un salon donné
     *
     * @param int $roomId
     * @return Message[]
     */
    public function findAllByRoom(int $roomId): array
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('SELECT * FROM messages WHERE room_id = :room_id ORDER BY created_at ASC');
        $stmt->execute(['room_id' => $roomId]);

        $messages = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $messages[] = new Message(
                $row['id'],
                $row['room_id'],
                $row['content'],
                $row['created_at']
            );
        }

        return $messages;
    }

    /**
     * Insère un message
     */
    public function insert(Message $message): int
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('INSERT INTO messages (room_id, content) VALUES (:room_id, :content)');
        $stmt->execute([
            'room_id' => $message->getRoomId(),
            'content' => $message->getContent()
        ]);

        return (int) $pdo->lastInsertId();
    }

    /**
     * Supprime un message (optionnel si besoin)
     */
    public function delete(int $id): bool
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->prepare('DELETE FROM messages WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}
