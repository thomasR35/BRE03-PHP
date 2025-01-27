<?php

/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */

class CommentManager extends AbstractManager
{
    public function findByPost(int $postId): array
    {
        $query = $this->db->prepare('SELECT * FROM comments WHERE post_id = :postId ORDER BY id DESC');
        $query->execute(['postId' => $postId]);
        $comments = [];
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $comments[] = (new Comment())
                ->setId((int)$row['id'])
                ->setContent($row['content']);
            // Charger également User et Post si nécessaire
        }
        return $comments;
    }

    public function create(Comment $comment): void
    {
        $query = $this->db->prepare(
            'INSERT INTO comments (content, post_id, user_id) 
             VALUES (:content, :postId, :userId)'
        );
        $query->execute([
            'content' => htmlspecialchars($comment->getContent()), // Protection XSS
            'postId' => $comment->getPost()->getId(),
            'userId' => $comment->getUser()->getId()
        ]);
    }
}
