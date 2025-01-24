<?php

namespace Controllers;

class PageController extends BaseController
{
    public function home()
    {
        // Exemple pour la page d'accueil
        $this->render('pages/home', [
            'title' => 'Bienvenue sur Distorsion',
            'content' => 'Ceci est la page d\'accueil.'
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
