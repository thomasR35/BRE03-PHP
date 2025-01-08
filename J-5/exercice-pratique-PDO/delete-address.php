<?php

require 'connexion.php';

$id = $_POST['id'];

$query_users = $db->prepare('DELETE FROM users WHERE address = :id');
$query_users->execute(['id' => $id]);

$query = $db->prepare('DELETE FROM address WHERE id = :id');
$query->execute(['id' => $id]);

?>
