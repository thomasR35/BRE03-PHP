<?php

/**
 * Autoloader pour charger automatiquement les classes.
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */

spl_autoload_register(function ($class) {
    // Liste des répertoires où chercher les fichiers
    $directories = [
        __DIR__ . '/../models/',       // Répertoire des modèles
        __DIR__ . '/../managers/',     // Répertoire des managers
        __DIR__ . '/../controllers/', // Répertoire des contrôleurs
        __DIR__ . '/../services/'      // Répertoire des services
    ];

    // Rechercher dans chaque répertoire
    foreach ($directories as $directory) {
        $file = $directory . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }

    // Si la classe n'est pas trouvée
    die("Impossible de charger la classe : $class");
});
