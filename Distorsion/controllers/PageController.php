<?php

namespace Controllers;

class PageController extends BaseController
{
    public function home(): void
    {
        // Récupérer les catégories
        $categories = $this->categoryManager->findAll();

        // Récupérer les salons (par exemple, les 5 plus récents)
        $rooms = $this->roomManager->findRecent(5);

        // Passer les données à la vue
        $this->render('pages/home', [
            'categories' => $categories,
            'rooms' => $rooms
        ]);
    }

    public function about()
    {
        // Exemple pour la page "À propos"
        $this->render('pages/about', [
            'title' => 'À propos de Distorsion',
            'content' => 'Description du projet, objectifs, etc.'
        ]);
    }
}
