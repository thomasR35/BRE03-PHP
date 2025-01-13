<?php
require 'User.php';

$user1 = new User(1, 'admin', 'admin');
$user2 = new User(2, 'user', 'user');

echo "User 1 : ID = {$user1->getId()}, Username = {$user1->getUsername()}, Password = {$user1->getPassword()}<br>";
echo "User 2 : ID = {$user2->getId()}, Username = {$user2->getUsername()}, Password = {$user2->getPassword()}";
