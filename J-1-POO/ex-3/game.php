<?php
require 'Weapon.php';
require 'Character.php';

$ragnar = new Character("Ragnar");
$sword = new Weapon("Sword", 10);


$ragnar->setWeapon($sword);

echo "Character: " . $ragnar->getName() . "<br>";
echo "Weapon: " . $ragnar->getWeapon()->getName() . "<br>";
echo "Damages: " . $ragnar->getWeapon()->getDamages() . "<br>";

echo $ragnar->fight();
?>