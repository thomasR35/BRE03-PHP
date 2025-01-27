<?php

/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */
require_once 'User.php'; // Assurez-vous d'avoir le modèle User
require_once 'Post.php'; // Assurez-vous d'avoir le modèle Post

class Comment
{
    private int $id;
    private string $content;
    private Post $post;
    private User $author;

    public function __construct(int $id, string $content, Post $post, User $author)
    {
        $this->id = $id;
        $this->content = $content;
        $this->post = $post;
        $this->author = $author;
    }

    // Getters et Setters
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getPost(): Post
    {
        return $this->post;
    }

    public function setPost(Post $post): void
    {
        $this->post = $post;
    }

    public function getAuthor(): User
    {
        return $this->author;
    }

    public function setAuthor(User $author): void
    {
        $this->author = $author;
    }
}
