<?php

spl_autoload_register(function ($class) {
    $paths = ['controllers/', 'models/', 'managers/', 'config/'];
    foreach ($paths as $path) {
        $file = __DIR__ . '/../' . $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});


require_once __DIR__ . '/../controllers/UserController.php';
