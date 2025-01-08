<?php

require 'connexion.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int) $_GET['id'];

    $query = $db->prepare(
        'SELECT 
            users.id, 
            users.first_name,
            users.last_name, 
            users.email, 
            address.street, 
            address.city, 
            address.zipcode 
         FROM 
            users 
         JOIN 
            address 
         ON 
            users.id = address.id 
         WHERE 
            users.id = :id'
    );

    $query->execute(['id' => $id]);

    $user_with_address = $query->fetch(PDO::FETCH_ASSOC);

    if ($user_with_address) {
        var_dump($user_with_address);
    } else {
        echo "Aucun utilisateur trouvé avec l'ID : $id";
    }
} else {
    echo "Veuillez fournir un ID valide dans l'URL.";
}
?>
