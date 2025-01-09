<?php
require '../connexion.php';

if (isset($_POST['first_name'], $_POST['last_name'], $_POST['email'], $_POST['password'])) {
    
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $db->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");
    $stmt->execute([$first_name, $last_name, $email, $hashed_password]);

    header('Location: ../index.php?route=home');
    exit;
}
?>

