<?php

require 'connexion.php';

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
        users.address = address.id'
);

$query->execute();

$users_with_addresses = $query->fetchAll(PDO::FETCH_ASSOC);

if ($users_with_addresses) {
    var_dump($users_with_addresses);
} else {
    echo "Aucun utilisateur avec une adresse trouvée.";
}

?>

