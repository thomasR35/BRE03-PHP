<?php

require 'connexion.php';


if (isset($_GET['id']) && is_numeric($_GET['id'])) {
   
    $id = (int) $_GET['id'];
    $query = $db->prepare('SELECT * FROM users WHERE id = :id');
    $query->execute(['id' => $id]);

    
    $user = $query->fetch(PDO::FETCH_ASSOC);

    
    if ($user) {
        var_dump($user);
    } else {
        echo "Aucun utilisateur trouvé avec l'ID : $id";
    }
} else {
    echo "Veuillez fournir un ID valide dans l'URL.";
}
?>
