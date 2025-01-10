<?php

function homePage() : void
{
    require "managers/post_manager.php";

    // remplacez ce code pour appeler la fonction qui permet de récupérer tous les articles de la base de données
    $posts = null;

    $template = "templates/home.phtml";
    require "templates/layout.phtml";
}

?>