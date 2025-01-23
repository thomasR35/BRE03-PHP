<?php
class UserController
{
    private UserManager $userManager;

    public function __construct()
    {
        $this->userManager = new UserManager();
    }

    public function list()
    {
        $users = $this->userManager->selectAll();
        $route = 'templates/users/list.phtml';
        $title = 'Liste des utilisateurs';
        require 'templates/layout.phtml';
    }

    public function show()
    {
        $userId = $_GET['id'] ?? null;
        if ($userId) {
            $user = $this->userManager->selectOneById($userId);
            if ($user) {
                $route = 'templates/users/show.phtml';
                $title = 'Détails de l\'utilisateur';
                require 'templates/layout.phtml';
            } else {
                // Gérer le cas où l'utilisateur n'est pas trouvé
            }
        } else {
            // Gérer le cas où l'ID n'est pas fourni
        }
    }

    public function create()
    {
        $route = 'templates/users/create.phtml';
        $title = 'Créer un utilisateur';
        require 'templates/layout.phtml';
    }

    public function checkCreate()
    {
        // Récupérer les données du formulaire
        $email = $_POST['email'] ?? '';
        $firstName = $_POST['first_name'] ?? '';
        $lastName = $_POST['last_name'] ?? '';

        // Hydrater une instance de la classe User
        $user = new User($email, $firstName, $lastName);

        // Instancier un UserManager et transmettre l'instance à sa méthode create()
        $this->userManager->create($user);

        // Rediriger vers la page de liste des utilisateurs
        header('Location: index.php');
        exit;
    }

    public function update()
    {
        $userId = $_GET['id'] ?? null;
        if ($userId) {
            $user = $this->userManager->selectOneById($userId);
            if ($user) {
                $route = 'templates/users/update.phtml';
                $title = 'Mettre à jour un utilisateur';
                require 'templates/layout.phtml';
            } else {
                // Gérer le cas où l'utilisateur n'est pas trouvé
                echo "Utilisateur non trouvé.";
            }
        } else {
            // Gérer le cas où l'ID n'est pas fourni
            echo "ID utilisateur non fourni.";
        }
    }


    public function checkUpdate()
    {
        // Récupérer les données du formulaire
        $userId = $_POST['id'] ?? null;
        $email = $_POST['email'] ?? '';
        $firstName = $_POST['first_name'] ?? '';
        $lastName = $_POST['last_name'] ?? '';

        // Hydrater une instance de la classe User
        $user = new User($email, $firstName, $lastName, $userId);

        // Instancier un UserManager et transmettre l'instance à sa méthode update()
        $this->userManager->update($user);

        // Rediriger vers la page de liste des utilisateurs
        header('Location: index.php');
        exit;
    }


    public function delete()
    {
        $userId = $_GET['id'] ?? null;
        if ($userId) {
            $this->userManager->delete($userId);
            // Rediriger vers la page de liste des utilisateurs
            header('Location: index.php');
            exit;
        } else {
            // Gérer le cas où l'ID n'est pas fourni
            echo "ID utilisateur non fourni.";
        }
    }
}
