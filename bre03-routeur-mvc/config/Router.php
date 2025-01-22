<?php

class Router
{
    public function handleRequest(array $get): void
    {
        if (isset($get['route'])) {
            if ($get['route'] === 'a-propos') {
                $controller = new PageController();
                $controller->about();
            } elseif ($get['route'] === 'contact') {
                $controller = new PageController();
                $controller->contact();
            } else {
                $controller = new PageController();
                $controller->notFound();
            }
        } else {
            $controller = new PageController();
            $controller->home();
        }
    }
}
