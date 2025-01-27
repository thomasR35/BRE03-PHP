<?php

/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */

require_once 'User.php'; // Assurez-vous d'avoir le modèle User
require_once 'Category.php'; // Si besoin de la catégorie dans Post

class Post
{
    public int $id;
    public string $title;
    public string $content;
    public string $excerpt;
    public DateTime $createdAt;
    public User $author; // Composition : Post a un auteur de type User

    /**
     * Constructeur de la classe Post
     */
    public function __construct(
        int $id,
        string $title,
        string $content,
        string $excerpt,
        DateTime $createdAt,
        User $author
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->excerpt = $excerpt;
        $this->createdAt = $createdAt;
        $this->author = $author;
    }
}
