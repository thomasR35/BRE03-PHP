<?php

namespace Models;

class Message
{
    private ?int $id = null;
    private ?int $roomId = null;
    private ?string $content = null;
    private ?string $createdAt = null;

    public function __construct(
        ?int $id = null,
        ?int $roomId = null,
        ?string $content = null,
        ?string $createdAt = null
    ) {
        $this->id = $id;
        $this->roomId = $roomId;
        $this->content = $content;
        $this->createdAt = $createdAt;
    }

    // --- Getters / Setters ---

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getRoomId(): ?int
    {
        return $this->roomId;
    }

    public function setRoomId(int $roomId): void
    {
        $this->roomId = $roomId;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}
