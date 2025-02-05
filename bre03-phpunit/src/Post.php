<?php

namespace App;

use InvalidArgumentException; // Importation de l'exception pour gérer les erreurs de validation

/**
 * Classe représentant un article (Post)
 */
class Post
{
    // Déclaration des attributs privés
    private string $title;   // Titre de l'article
    private string $content; // Contenu de l'article
    private string $slug;    // Slug (URL unique de l'article)
    private bool $private;   // Statut de confidentialité (true = privé, false = public)

    /**
     * Constructeur de la classe Post
     *
     * @param string $title - Titre de l'article (ne peut pas être vide)
     * @param string $content - Contenu de l'article (ne peut pas être vide)
     * @param string $slug - Identifiant unique (slug) pour l'URL (doit être "URL safe")
     * @param bool $private - Indique si le post est privé ou public (par défaut public)
     * 
     * @throws InvalidArgumentException - Si les valeurs ne respectent pas les règles de validation
     */
    public function __construct(string $title, string $content, string $slug, bool $private = false)
    {
        // Vérifie que le titre n'est pas vide
        if (empty($title)) {
            throw new InvalidArgumentException("Le titre ne peut pas être vide.");
        }

        // Vérifie que le contenu n'est pas vide
        if (empty($content)) {
            throw new InvalidArgumentException("Le contenu ne peut pas être vide.");
        }

        // Vérifie que le slug est valide (ne peut pas être vide et doit être "URL safe")
        if (empty($slug) || !preg_match('/^[a-z0-9-]+$/', $slug)) {
            throw new InvalidArgumentException("Le slug ne peut pas être vide et doit être URL safe.");
        }

        // Initialisation des attributs de l'objet
        $this->title = $title;
        $this->content = $content;
        $this->slug = $slug;
        $this->private = $private;
    }

    // ======================
    // GETTERS (Accesseurs)
    // ======================

    /**
     * Retourne le titre de l'article
     *
     * @return string - Le titre
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Retourne le contenu de l'article
     *
     * @return string - Le contenu
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Retourne le slug de l'article
     *
     * @return string - Le slug
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * Indique si l'article est privé ou public
     *
     * @return bool - true si privé, false si public
     */
    public function isPrivate(): bool
    {
        return $this->private;
    }

    // ======================
    // SETTERS (Mutateurs)
    // ======================

    /**
     * Modifie le titre de l'article
     *
     * @param string $title - Nouveau titre
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Modifie le contenu de l'article
     *
     * @param string $content - Nouveau contenu
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * Modifie le slug de l'article
     *
     * @param string $slug - Nouveau slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * Modifie la confidentialité de l'article (public/privé)
     *
     * @param bool $private - true pour privé, false pour public
     */
    public function setPrivate(bool $private): void
    {
        $this->private = $private;
    }
}
