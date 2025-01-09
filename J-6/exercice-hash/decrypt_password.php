<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $plainPassword = $_POST['plain_password'];
    $hashedPassword = $_POST['hashed_password'];

    if (password_verify($plainPassword, $hashedPassword)) {
        echo "<h1>Mot de passe correct</h1>";
    } else {
        echo "<h1>Mot de passe erroné</h1>";
    }
} else {
    echo "<p>Veuillez soumettre un mot de passe pour le tester.</p>";
}
?>
