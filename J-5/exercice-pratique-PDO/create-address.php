<?php

require 'connexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $street = $_POST['street'];
    $city = $_POST['city'];
    $zipcode = $_POST['zipcode'];

    if (empty($street) || empty($city) || empty($zipcode)) {
        echo "Tous les champs doivent être remplis.";
    } else {
        $query = $db->prepare(
            'INSERT INTO address (street, city, zipcode) 
             VALUES (:street, :city, :zipcode)'
        );

        $query->execute([
            'street' => $street,
            'city' => $city,
            'zipcode' => $zipcode
        ]);

        echo "Adresse ajoutée avec succès !";
    }
} else {
    echo "Veuillez soumettre le formulaire.";
}
?>

