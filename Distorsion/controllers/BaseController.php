<?php

namespace Controllers;

use Managers\CategoryManager;
use Managers\RoomManager;

abstract class BaseController
{
    protected CategoryManager $categoryManager;
    protected RoomManager $roomManager;

    public function __construct()
    {
        $this->categoryManager = new CategoryManager();
        $this->roomManager = new RoomManager();
    }

    protected function render(string $view, array $params = []): void
    {
        try {
            // Récupérer la liste des catégories
            $this->categoryManager->findAll();
        } catch (\Exception $e) {
            // Diagnostiquer les erreurs
            die('Erreur lors de la récupération des catégories : ' . $e->getMessage());
        }

        // Extraction des paramètres
        extract($params);

        // Inclusion des templates
        require __DIR__ . '/../templates/layout/header.phtml';
        require __DIR__ . '/../templates/' . $view . '.phtml';
        require __DIR__ . '/../templates/layout/footer.phtml';
    }
}
