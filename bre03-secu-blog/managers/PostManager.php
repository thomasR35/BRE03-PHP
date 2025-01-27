<?php

/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */

class PostManager extends AbstractManager
{
    public function findLatest(): array
    {
        $query = $this->db->query('SELECT * FROM posts ORDER BY created_at DESC LIMIT 4');
        $posts = [];
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $posts[] = (new Post())
                ->setId((int)$row['id'])
                ->setTitle($row['title'])
                ->setContent($row['content'])
                ->setExcerpt($row['excerpt'])
                ->setCreatedAt(new DateTime($row['created_at']));
            // Ajouter un User et une Category ici si nécessaire
        }
        return $posts;
    }

    public function findOne(int $id): ?Post
    {
        $query = $this->db->prepare('SELECT * FROM posts WHERE id = :id');
        $query->execute(['id' => $id]);
        $row = $query->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return (new Post())
                ->setId((int)$row['id'])
                ->setTitle($row['title'])
                ->setContent($row['content'])
                ->setExcerpt($row['excerpt'])
                ->setCreatedAt(new DateTime($row['created_at']));
        }
        return null;
    }

    public function findByCategory(int $categoryId): array
    {
        $query = $this->db->prepare(
            'SELECT * FROM posts 
             WHERE id IN (
                 SELECT post_id FROM posts_categories WHERE category_id = :categoryId
             )'
        );
        $query->execute(['categoryId' => $categoryId]);
        $posts = [];
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $posts[] = (new Post())
                ->setId((int)$row['id'])
                ->setTitle($row['title'])
                ->setContent($row['content'])
                ->setExcerpt($row['excerpt'])
                ->setCreatedAt(new DateTime($row['created_at']));
        }
        return $posts;
    }
}
