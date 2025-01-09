<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tester un mot de passe</title>
</head>
<body>
    <h1>Testez votre mot de passe</h1>
    <form action="decrypt_password.php" method="post">
        <label for="plain_password">Mot de passe en clair : </label>
        <input type="password" id="plain_password" name="plain_password" required>
        <label for="hashed_password">Mot de passe chiffré : </label>
        <input type="text" id="hashed_password" name="hashed_password" required>
        <button type="submit">Vérifier le mot de passe</button>
    </form>
</body>
</html>
