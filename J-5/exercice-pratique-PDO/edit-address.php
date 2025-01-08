<?php

require 'connexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $id = $_POST['id'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    $zipcode = $_POST['zipcode'];

    $query = $db->prepare(
        'UPDATE address 
         SET street = :street, city = :city, zipcode = :zipcode 
         WHERE id = :id'
    );

    $query->execute([
        'id' => $id,
        'street' => $street,
        'city' => $city,
        'zipcode' => $zipcode
    ]);

    echo "Adresse mise à jour avec succès !";
}
?>
