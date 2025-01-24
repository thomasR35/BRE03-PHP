<?php

spl_autoload_register(function ($class) {
    // Remplace les namespaces par des chemins d'accès relatifs
    $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    // Construit le chemin du fichier
    $file = __DIR__ . '/../' . $classPath . '.php';

    if (file_exists($file)) {
        require_once $file;
    } else {
        // Erreur si le fichier n'existe pas
        die("Impossible de charger la classe : {$class}");
    }
});
