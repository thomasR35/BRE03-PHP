<?php

class UserController
{
    public function list()
    {
        $route = __DIR__ . '/../templates/users/list.phtml';
        require __DIR__ . '/../templates/layout.phtml';
    }

    public function show()
    {
        $route = __DIR__ . '/../templates/users/show.phtml';
        require __DIR__ . '/../templates/layout.phtml';
    }

    public function create()
    {
        $route = __DIR__ . '/../templates/users/create.phtml';
        require __DIR__ . '/../templates/layout.phtml';
    }

    public function checkCreate()
    {
        echo "Méthode checkCreate() appelée.";
    }

    public function update()
    {
        $route = __DIR__ . '/../templates/users/update.phtml';
        require __DIR__ . '/../templates/layout.phtml';
    }

    public function checkUpdate()
    {
        echo "Méthode checkUpdate() appelée.";
    }

    public function delete()
    {
        echo "Méthode delete() appelée.";
    }
}
