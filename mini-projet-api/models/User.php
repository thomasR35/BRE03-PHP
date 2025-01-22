<?php
// models/User.php
class User
{
    private ?int $id;
    private string $username;
    private string $email;
    private string $password;
    private string $role;
    private DateTime $createdAt;

    public function __construct(string $username, string $email, string $password, string $role, ?int $id = null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->createdAt = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function toArray(): array
    {
        return [
            "id" => $this->id,
            "username" => $this->username,
            "email" => $this->email,
            "password" => $this->password,
            "role" => $this->role
        ];
    }
}
