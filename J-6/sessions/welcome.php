<?php
session_start();
$pseudo = isset($_SESSION['pseudo']) ? $_SESSION['pseudo'] : 'invité';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue</title>
</head>
<body>
    <h1>Bienvenue <?php echo $pseudo; ?> !</h1>
</body>
</html>