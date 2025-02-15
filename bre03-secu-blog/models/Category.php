<?php

/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */

class Category
{
    private int $id;
    private string $title;
    private ?string $description; // Peut être null si non obligatoire

    // Getters et setters
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }
}
