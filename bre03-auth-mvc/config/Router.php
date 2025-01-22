<?php

class Router
{
    public function handleRequest(array $get): void
    {
        $route = $get['route'] ?? 'connexion';

        switch ($route) {
            case 'connexion':
                (new AuthController())->showConnexionForm();
                break;
            case 'check-connexion':
                (new AuthController())->handleConnexion();
                break;
            case 'inscription':
                (new AuthController())->showInscriptionForm();
                break;
            case 'check-inscription':
                (new AuthController())->handleInscription();
                break;
            case 'espace-perso':
                if (isset($_SESSION['user'])) {
                    (new PageController())->showEspacePerso();
                } else {
                    header('Location: index.php?route=connexion');
                    exit();
                }
                break;
            case 'deconnexion':
                (new AuthController())->handleLogout();
                break;
            default:
                (new PageController())->notFound();
                break;
        }
    }
}
