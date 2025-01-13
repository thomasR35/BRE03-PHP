<?php
require 'character.php';

$character = new Character(1);

echo "Nom complet : " . $character->getFullName() . "<br>";

$character->setFirstName("Sarah");
$character->setLastName("Connor");

echo "Nom complet après modification : " . $character->getFullName();
