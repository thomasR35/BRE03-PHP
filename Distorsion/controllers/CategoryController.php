<?php

namespace Controllers;

use Managers\CategoryManager;
use Models\Category;

class CategoryController extends BaseController
{

    public function __construct()
    {
        $this->categoryManager = new CategoryManager();

        // On s'assure que la session est démarrée,
        // pour avoir accès au rôle de l'utilisateur.
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Méthode privée pour restreindre l'accès aux admins
     */
    private function checkAdmin(): void
    {
        // Vérifie si l'utilisateur est connecté ET qu'il a le rôle 'admin'
        if (empty($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            http_response_code(403);
            if (empty($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
                $this->redirectWithMessage("Accès refusé : vous devez être administrateur pour cette action.", 'index.php?route=/error/accessDenied');
            }
        }
    }

    /**
     * Affiche la liste de toutes les catégories
     */
    public function listCategories(): void
    {
        $categories = $this->categoryManager->findAll();

        $this->render('category/list', [
            'categories' => $categories
        ]);
    }

    /**
     * Formulaire pour créer une nouvelle catégorie
     * (réservé aux admins)
     */
    public function createCategory(): void
    {
        $this->checkAdmin();

        $this->render('category/create');
    }

    /**
     * Traitement du formulaire de création d'une catégorie
     * (réservé aux admins)
     */
    public function storeCategory(): void
    {
        $this->checkAdmin();

        if (!empty($_POST['name'])) {
            $category = new Category();
            $category->setName($_POST['name']);

            // Insertion en base
            $this->categoryManager->insert($category);

            // Redirection vers la liste
            header('Location: index.php?route=/categories');
            exit;
        } else {
            // En cas d'erreur ou champ vide
            $this->render('category/create', [
                'error' => 'Le nom de la catégorie est requis.'
            ]);
        }
    }

    /**
     * Formulaire pour modifier une catégorie
     * (réservé aux admins)
     */
    public function editCategory(): void
    {
        $this->checkAdmin();

        $id = $_GET['id'] ?? null;

        if ($id) {
            $category = $this->categoryManager->find((int) $id);

            if ($category) {
                $this->render('category/edit', [
                    'category' => $category
                ]);
            } else {
                echo "Catégorie introuvable.";
            }
        } else {
            echo "Identifiant non spécifié.";
        }
    }

    /**
     * Traitement du formulaire de modification
     * (réservé aux admins)
     */
    public function updateCategory(): void
    {
        $this->checkAdmin();

        if (!empty($_POST['id']) && !empty($_POST['name'])) {
            $category = $this->categoryManager->find((int)$_POST['id']);

            if ($category) {
                $category->setName($_POST['name']);
                $this->categoryManager->update($category);

                header('Location: index.php?route=/categories');
                exit;
            } else {
                echo "Catégorie introuvable.";
            }
        } else {
            echo "Les champs sont requis.";
        }
    }

    /**
     * Suppression d'une catégorie
     * (réservé aux admins)
     */
    public function deleteCategory(): void
    {
        $this->checkAdmin();

        $id = $_GET['id'] ?? null;

        if ($id) {
            $this->categoryManager->delete((int) $id);
            header('Location: index.php?route=/categories');
            exit;
        } else {
            echo "Identifiant non spécifié.";
        }
    }
}
