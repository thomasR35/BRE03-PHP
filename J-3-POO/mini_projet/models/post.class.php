<?php

namespace mini_projet\Models;

class Post
{
    private ?int $id = null;
    private string $title;
    private string $content;
    private string $excerpt;
    private \DateTime $createdAt;
    private User $author;
    private array $categories = [];

    public function __construct(string $title, string $content, string $excerpt, \DateTime $createdAt, User $author)
    {
        $this->title = $title;
        $this->content = $content;
        $this->excerpt = $excerpt;
        $this->createdAt = $createdAt;
        $this->author = $author;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
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

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): void
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

    public function getCategories(): array
    {
        return $this->categories;
    }

    public function setCategories(array $categories): void
    {
        $this->categories = $categories;
    }

    public function addCategory(Category $category): void
    {
        $this->categories[] = $category;
    }


    public function removeCategory(Category $category): void
    {
        $this->categories = array_values(array_diff($this->categories, [$category]));
    }
}
