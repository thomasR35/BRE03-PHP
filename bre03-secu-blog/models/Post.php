<?php

/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */

require_once 'User.php'; // Assurez-vous d'avoir le modèle User
require_once 'Category.php'; // Si besoin de la catégorie dans Post

class Post
{
    private int $id;
    private string $title;
    private string $content;
    private string $excerpt;
    private DateTime $createdAt;
    private User $author;
    private Category $category;

    public function __construct(
        int $id,
        string $title,
        string $content,
        string $excerpt,
        DateTime $createdAt,
        User $author,
        Category $category
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->excerpt = $excerpt;
        $this->createdAt = $createdAt;
        $this->author = $author;
        $this->category = $category;
    }

    // Getters et Setters pour chaque propriété
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getExcerpt(): string
    {
        return $this->excerpt;
    }

    public function setExcerpt(string $excerpt): void
    {
        $this->excerpt = $excerpt;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getAuthor(): User
    {
        return $this->author;
    }

    public function setAuthor(User $author): void
    {
        $this->author = $author;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): void
    {
        $this->category = $category;
    }
}
