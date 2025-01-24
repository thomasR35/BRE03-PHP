<?php

namespace Routes;

class Router
{
    private array $routes = [];

    /**
     * Ajoute une route à la liste.
     *
     * @param string $path Le chemin de la route (ex: /categories)
     * @param callable|array $callback Le contrôleur et l'action
     */
    public function add(string $path, callable|array $callback): void
    {
        $this->routes[$path] = $callback;
    }

    /**
     * Exécute la route correspondant à l'URL actuelle.
     */
    public function handle(): void
    {
        $path = $_GET['route'] ?? '/';

        if (isset($this->routes[$path])) {
            $callback = $this->routes[$path];

            if (is_callable($callback)) {
                call_user_func($callback);
            } elseif (is_array($callback) && count($callback) === 2) {
                $controller = new $callback[0]();
                $method = $callback[1];

                if (method_exists($controller, $method)) {
                    $controller->$method();
                } else {
                    $this->notFound("Méthode {$method} introuvable dans le contrôleur.");
                }
            } else {
                $this->notFound("Callback invalide pour la route : {$path}");
            }
        } else {
            $this->notFound("Route introuvable : {$path}");
        }
    }

    /**
     * Gestion des erreurs 404.
     *
     * @param string $message Le message d'erreur
     */
    private function notFound(string $message): void
    {
        http_response_code(404);
        echo "<h1>404 Not Found</h1><p>{$message}</p>";
        exit;
    }
}
