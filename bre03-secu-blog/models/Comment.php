<?php

/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */
require_once 'User.php'; // Assurez-vous d'avoir le modèle User
require_once 'Post.php'; // Assurez-vous d'avoir le modèle Post

class Comment
{
    public int $id;
    public string $content;
    public Post $post; // Relation : le commentaire est lié à un post
    public User $author; // Relation : le commentaire est lié à un utilisateur

    /**
     * Constructeur de la classe Comment
     */
    public function __construct(
        int $id,
        string $content,
        Post $post,
        User $author
    ) {
        $this->id = $id;
        $this->content = $content;
        $this->post = $post;
        $this->author = $author;
    }
}
