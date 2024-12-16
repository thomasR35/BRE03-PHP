<?php 
    $connectedUser = false;
?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title>Exercice 2</title>
    </head>
    <body>
        <header>
            <nav>
                <?php 
                if ($connectedUser === false) {
                    echo '<a href="#">Connexion</a>';
                } else {
                    echo '<a href="#">Déconnexion</a>';
                }
                ?>
            </nav>
        </header>
    </body>
</html>
