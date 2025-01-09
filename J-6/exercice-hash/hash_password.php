<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    echo "<h1>Mot de passe chiffré</h1>";
    echo "<p>Mot de passe original : " . htmlspecialchars($password) . "</p>";
    echo "<p>Mot de passe chiffré : " . htmlspecialchars($hashedPassword) . "</p>";
} else {
    echo "<p>Veuillez soumettre un mot de passe pour le chiffrer.</p>";
}
?>
