<?php

namespace App;

use InvalidArgumentException;

class User
{
    // Déclaration des attributs privés
    private string $firstName;
    private string $lastName;
    private string $email;
    private string $password;
    private array $roles;

    /**
     * Constructeur de la classe User
     * 
     * @param string $firstName - Prénom de l'utilisateur (obligatoire)
     * @param string $lastName - Nom de l'utilisateur (obligatoire)
     * @param string $email - Email valide de l'utilisateur
     * @param string $password - Mot de passe sécurisé (8+ caractères, majuscule, chiffre, spécial)
     * @param array $roles - Liste des rôles de l'utilisateur (optionnel, par défaut "ANONYMOUS")
     */
    public function __construct(string $firstName, string $lastName, string $email, string $password, array $roles = [])
    {
        // Vérifie que le prénom et le nom ne sont pas vides
        if (empty($firstName) || empty($lastName)) {
            throw new InvalidArgumentException("Le prénom et le nom ne peuvent pas être vides.");
        }

        // Vérifie que l'email est valide
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Email invalide.");
        }

        // Vérifie que le mot de passe respecte les critères de sécurité
        if (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) {
            throw new InvalidArgumentException("Le mot de passe doit contenir 8 caractères minimum, une majuscule, un chiffre et un caractère spécial.");
        }

        // Si aucun rôle n'est défini, l'utilisateur est par défaut "ANONYMOUS"
        if (empty($roles)) {
            $roles = ["ANONYMOUS"];
        }

        // Vérification que les rôles fournis sont valides
        $validRoles = ["ANONYMOUS", "USER", "ADMIN"];
        foreach ($roles as $role) {
            if (!in_array($role, $validRoles)) {
                throw new InvalidArgumentException("Rôle invalide : $role.");
            }
        }

        // Si "USER" ou "ADMIN" est présent, on supprime "ANONYMOUS"
        if (in_array("USER", $roles) || in_array("ADMIN", $roles)) {
            $roles = array_diff($roles, ["ANONYMOUS"]);
        }

        // Initialisation des attributs de l'objet
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->roles = array_unique($roles);
    }

    // ======================
    // GETTERS (Accesseurs)
    // ======================

    /**
     * Retourne le prénom de l'utilisateur
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * Retourne le nom de l'utilisateur
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * Retourne l'email de l'utilisateur
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Retourne le mot de passe de l'utilisateur
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Retourne les rôles de l'utilisateur
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    // ======================
    // SETTERS (Mutateurs)
    // ======================

    /**
     * Met à jour le prénom de l'utilisateur (ne peut pas être vide)
     */
    public function setFirstName(string $firstName): void
    {
        if (empty($firstName)) {
            throw new InvalidArgumentException("Le prénom ne peut pas être vide.");
        }
        $this->firstName = $firstName;
    }

    /**
     * Met à jour le nom de l'utilisateur (ne peut pas être vide)
     */
    public function setLastName(string $lastName): void
    {
        if (empty($lastName)) {
            throw new InvalidArgumentException("Le nom ne peut pas être vide.");
        }
        $this->lastName = $lastName;
    }

    /**
     * Met à jour l'email de l'utilisateur (doit être valide)
     */
    public function setEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Email invalide.");
        }
        $this->email = $email;
    }

    /**
     * Met à jour le mot de passe (doit respecter les critères de sécurité)
     */
    public function setPassword(string $password): void
    {
        if (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $password)) {
            throw new InvalidArgumentException("Le mot de passe doit contenir 8 caractères minimum, une majuscule, un chiffre et un caractère spécial.");
        }
        $this->password = $password;
    }

    // ==========================
    // MÉTHODES DE GESTION DES RÔLES
    // ==========================

    /**
     * Ajoute un rôle à l'utilisateur
     *
     * @param string $newRole - Le rôle à ajouter ("USER" ou "ADMIN")
     * @return array - Liste des rôles après ajout
     */
    public function addRole(string $newRole): array
    {
        if (!in_array($newRole, ["USER", "ADMIN"])) {
            throw new InvalidArgumentException("Rôle invalide.");
        }

        // Ajout du rôle et suppression de "ANONYMOUS" si nécessaire
        $this->roles[] = $newRole;
        $this->roles = array_values(array_unique(array_diff($this->roles, ["ANONYMOUS"])));

        return $this->roles;
    }

    /**
     * Supprime un rôle à l'utilisateur
     *
     * @param string $role - Le rôle à supprimer
     * @return array - Liste des rôles après suppression
     */
    public function removeRole(string $role): array
    {
        // Suppression du rôle
        $this->roles = array_values(array_diff($this->roles, [$role]));

        // Si l'utilisateur n'a plus de rôles, on lui met "ANONYMOUS" par défaut
        if (empty($this->roles)) {
            $this->roles[] = "ANONYMOUS";
        }

        return $this->roles;
    }

    /**
     * Met à jour tous les rôles de l'utilisateur
     *
     * @param array $roles - Liste des nouveaux rôles
     */
    public function setRoles(array $roles): void
    {
        $this->roles = array_values(array_unique($roles));
    }
}
