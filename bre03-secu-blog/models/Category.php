<?php

/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */

class Category
{
    private int $id;
    private string $title;
    private string $description;

    public function __construct(int $id, string $title, string $description)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
    }

    // Getter pour l'ID
    public function getId(): int
    {
        return $this->id;
    }

    // Setter pour l'ID
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    // Getter pour le titre
    public function getTitle(): string
    {
        return $this->title;
    }

    // Setter pour le titre
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    // Getter pour la description
    public function getDescription(): string
    {
        return $this->description;
    }

    // Setter pour la description
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}
