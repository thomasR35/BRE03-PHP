<?php

namespace Models;

class User
{
    private ?int $id = null;
    private ?string $username = null;
    private ?string $password = null;
    private ?string $role = null;

    public function __construct(
        ?int $id = null,
        ?string $username = null,
        ?string $password = null,
        ?string $role = 'user'
    ) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
    }

    // --- Getters/Setters ---

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
    }
}
