<?php

namespace App;

use InvalidArgumentException;

class Post
{
    private string $title;
    private string $content;
    private string $slug;
    private bool $private;

    public function __construct(string $title, string $content, string $slug, bool $private = false)
    {
        if (empty($title)) {
            throw new InvalidArgumentException("Le titre ne peut pas être vide.");
        }
        if (empty($content)) {
            throw new InvalidArgumentException("Le contenu ne peut pas être vide.");
        }
        if (empty($slug) || !preg_match('/^[a-z0-9-]+$/', $slug)) {
            throw new InvalidArgumentException("Le slug ne peut pas être vide et doit être URL safe.");
        }

        $this->title = $title;
        $this->content = $content;
        $this->slug = $slug;
        $this->private = $private;
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

    public function getSlug(): string
    {
        return $this->slug;
    }
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function isPrivate(): bool
    {
        return $this->private;
    }
    public function setPrivate(bool $private): void
    {
        $this->private = $private;
    }
}
