<?php

namespace Controllers;

class ErrorController extends BaseController
{
    public function accessDenied(): void
    {
        $message = $_SESSION['flash_message'] ?? 'Une erreur s\'est produite.';
        unset($_SESSION['flash_message']); // Supprime le message après l'avoir affiché

        $this->render('error/accessDenied', [
            'message' => $message
        ]);
    }
}
