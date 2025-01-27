<?php

/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */
require_once 'AbstractManager.php';
require_once 'Comment.php';
require_once 'User.php';
require_once 'Post.php';

class CommentManager extends AbstractManager
{
    public function __construct()
    {
        parent::__construct();
    }

    // Retourne les commentaires d'un post
    public function findByPost(int $postId): array
    {
        $query = $this->db->prepare("
             SELECT comments.*, users.id AS user_id, users.username
             FROM comments
             JOIN users ON comments.user_id = users.id
             WHERE comments.post_id = :postId
         ");
        $query->execute(['postId' => $postId]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);

        $comments = [];
        foreach ($results as $result) {
            $author = new User($result['user_id'], $result['username'], '', '', '', new DateTime());
            $post = new Post($postId, '', '', '', new DateTime(), new User(0, '', '', '', '', new DateTime()));
            $comments[] = new Comment($result['id'], $result['content'], $post, $author);
        }

        return $comments;
    }

    // Insère un commentaire dans la base de données
    public function create(Comment $comment): void
    {
        $query = $this->db->prepare("
             INSERT INTO comments (content, post_id, user_id) 
             VALUES (:content, :postId, :userId)
         ");
        $query->execute([
            'content' => $comment->content,
            'postId' => $comment->post->id,
            'userId' => $comment->author->id
        ]);
    }
}
