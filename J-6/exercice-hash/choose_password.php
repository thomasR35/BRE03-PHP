<?php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choisir un mot de passe</title>
</head>
<body>
    <h1>Entrez votre mot de passe</h1>
    <form action="hash_password.php" method="post">
        <label for="password">Mot de passe : </label>
        <input type="password" id="password" name="password" required>
        <button type="submit">Chiffrer le mot de passe</button>
    </form>
</body>
</html>
