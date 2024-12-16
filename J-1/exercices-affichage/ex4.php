<?php 
    $users = [
        [
            "firstName" => "Bugs",
            "lastName" => "Bunny",
            "age" => 29
        ],
        [
            "firstName" => "Roger",
            "lastName" => "Rabbit",
            "age" => 17
        ]
    ];
?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title>Exercice 4</title>
    </head>
    <body>
        <h1>
            Liste des utilisateurs
        </h1>
        <ul>
            <?php 
            foreach ($users as $user) {
                if ($user["age"] >= 18) {
                    $status = "majeur";
                } else {
                    $status = "mineur";
                }
                echo "<li>" . $user["firstName"] . " " . $user["lastName"] . " est " . $status . ".</li>";
            }
            
            ?>
        </ul>
    </body>
</html>
