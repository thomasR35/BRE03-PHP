<?php
class PageController
{
    public function showEspacePerso(): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?route=connexion');
            exit;
        }

        $route = 'espace-perso';
        require 'templates/layout.phtml';
    }

    public function notFound(): void
    {
        $route = 'notFound';
        require 'templates/layout.phtml';
    }
}
