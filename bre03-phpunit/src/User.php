<?php

namespace App;

use InvalidArgumentException;

class User
{
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $password;
    private array $roles;

    public function __construct(string $firstName, string $lastName, string $email, string $password, array $roles = [])
    {
        if (empty($firstName) || empty($lastName)) {
            throw new InvalidArgumentException("Le prénom et le nom ne peuvent pas être vides.");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Email invalide.");
        }

        if (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) {
            throw new InvalidArgumentException("Le mot de passe doit contenir 8 caractères minimum, une majuscule, un chiffre et un caractère spécial.");
        }

        // Si aucun rôle n'est défini, on met par défaut "ANONYMOUS"
        if (empty($roles)) {
            $roles = ["ANONYMOUS"];
        }

        // Vérification des rôles valides
        $validRoles = ["ANONYMOUS", "USER", "ADMIN"];
        foreach ($roles as $role) {
            if (!in_array($role, $validRoles)) {
                throw new InvalidArgumentException("Rôle invalide : $role.");
            }
        }

        // Si "USER" ou "ADMIN" est présent, on enlève "ANONYMOUS"
        if (in_array("USER", $roles) || in_array("ADMIN", $roles)) {
            $roles = array_diff($roles, ["ANONYMOUS"]);
        }

        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->roles = array_unique($roles);
    }

    // Getters
    public function getFirstName(): string
    {
        return $this->firstName;
    }
    public function getLastName(): string
    {
        return $this->lastName;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function getPassword(): string
    {
        return $this->password;
    }
    public function getRoles(): array
    {
        return $this->roles;
    }

    // Setters
    public function setFirstName(string $firstName): void
    {
        if (empty($firstName)) {
            throw new InvalidArgumentException("Le prénom ne peut pas être vide.");
        }
        $this->firstName = $firstName;
    }

    public function setLastName(string $lastName): void
    {
        if (empty($lastName)) {
            throw new InvalidArgumentException("Le nom ne peut pas être vide.");
        }
        $this->lastName = $lastName;
    }

    public function setEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Email invalide.");
        }
        $this->email = $email;
    }

    public function setPassword(string $password): void
    {
        if (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) {
            throw new InvalidArgumentException("Le mot de passe doit contenir 8 caractères minimum, une majuscule, un chiffre et un caractère spécial.");
        }
        $this->password = $password;
    }

    public function addRole(string $newRole): array
    {
        if (!in_array($newRole, ["USER", "ADMIN"])) {
            throw new InvalidArgumentException("Rôle invalide.");
        }
        $this->roles[] = $newRole;
        $this->roles = array_unique(array_diff($this->roles, ["ANONYMOUS"]));
        return $this->roles;
    }

    public function removeRole(string $role): array
    {
        $this->roles = array_diff($this->roles, [$role]);
        if (empty($this->roles)) {
            $this->roles[] = "ANONYMOUS";
        }
        return $this->roles;
    }
    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }
}
