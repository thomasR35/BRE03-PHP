<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choisir un pseudo</title>
</head>
<body>
    <form action="nickname.php" method="post">
        <label for="pseudo">Entrez votre pseudo :</label>
        <input type="text" id="pseudo" name="pseudo" required>
        <button type="submit">Envoyer</button>
    </form>
</body>
</html>