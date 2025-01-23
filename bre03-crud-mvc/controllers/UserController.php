<?php
class UserController
{
    private UserManager $userManager;

    public function __construct()
    {
        $this->userManager = new UserManager();
    }

    public function list()
    {
        $route = 'templates/users/list.phtml';
        $title = 'Liste des utilisateurs';
        require 'templates/layout.phtml';
    }

    public function show()
    {
        $route = 'templates/users/show.phtml';
        $title = 'Détails de l\'utilisateur';
        require 'templates/layout.phtml';
    }

    public function create()
    {
        $route = 'templates/users/create.phtml';
        $title = 'Créer un utilisateur';
        require 'templates/layout.phtml';
    }

    public function checkCreate()
    {
        // Logique pour vérifier la création de l'utilisateur
        // Redirection ou message de succès/erreur
    }

    public function update()
    {
        $route = 'templates/users/update.phtml';
        $title = 'Mettre à jour un utilisateur';
        require 'templates/layout.phtml';
    }

    public function checkUpdate()
    {
        // Logique pour vérifier la mise à jour de l'utilisateur
        // Redirection ou message de succès/erreur
    }

    public function delete()
    {
        // Logique pour supprimer l'utilisateur
        // Redirection ou message de succès/erreur
    }
}
