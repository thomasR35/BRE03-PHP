<?php

namespace mini_projet\Models;

class Category
{
    private ?int $id = null;
    private string $title;
    private string $description;
    private array $posts = [];

    public function __construct(string $title, string $description)
    {
        $this->title = $title;
        $this->description = $description;
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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getPosts(): array
    {
        return $this->posts;
    }

    public function setPosts(array $posts): void
    {
        $this->posts = $posts;
    }

    public function addPost(Post $post): void
    {
        if (!in_array($post, $this->posts, true)) {
            $this->posts[] = $post;
        }
    }

    public function removePost(Post $post): void
    {
        $this->posts = array_filter($this->posts, fn($p) => $p !== $post);
    }
}
