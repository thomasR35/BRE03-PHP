<?php

function categoryPage() : void
{
    // remplacez ce code pour récupérer l'id de la catégorie passé en paramètres
    $categoryId = $_GET["category"];

    require "managers/category_manager.php";

    // remplacez ce code pour appeler la fonction qui permet de récupérer tous les articles d'une catégorie
    $categoryPosts = null;

    $template = "templates/category.phtml";
    require "templates/layout.phtml";
}

?>