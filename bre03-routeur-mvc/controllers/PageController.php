<?php

class PageController
{
    public function home(): void
    {
        $route = 'home';
        require 'templates/layout.phtml';
    }

    public function about(): void
    {
        $route = 'about';
        require 'templates/layout.phtml';
    }

    public function notFound(): void
    {
        $route = 'notFound';
        require 'templates/layout.phtml';
    }

    public function contact(): void
    {
        $route = 'contact';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = htmlspecialchars($_POST['name']);
            $email = htmlspecialchars($_POST['email']);
            $message = htmlspecialchars($_POST['message']);

            $successMessage = "Merci $name, votre message a bien été envoyé !";
        }

        require 'templates/layout.phtml';
    }
}
