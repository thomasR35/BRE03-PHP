<?php
function moyenneNotes($array, $precision = 2) {
    $sum = array_sum($array);
    $average = round($sum / count($array), $precision);
    return $average;
  }

$students = [
    [
        "firstName" => "Hannah",
        "lastName" => "Fields",
        "grades" => [12, 11, 15],
        "average" => -1
    ],
    [
        "firstName" => "Richard",
        "lastName" => "Stein",
        "grades" => [18, 12, 13],
        "average" => -1
    ],
    [
        "firstName" => "Mark",
        "lastName" => "Hartoff",
        "grades" => [9, 11, 10],
        "average" => -1
    ],
    [
        "firstName" => "Charlie",
        "lastName" => "Nestle",
        "grades" => [9, 8, 5],
        "average" => -1
    ],
    [
        "firstName" => "Suzy",
        "lastName" => "Brent",
        "grades" => [18, 15, 16],
        "average" => -1
    ]
];


foreach ($students as $key => $student) {

    $students[$key]['average'] = moyenneNotes($student['grades']);
};
?>

<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <title>Bulletin de notes</title>
        <link rel="stylesheet" href="style.css" />
    </head>
    <body>
        <h1>
            Bulletin de notes
        </h1>
        <h2>
            Liste des étudiants
        </h2>
        <ul id="students">
            <?php 
                foreach ($students as $student) {
                    if ($student['average'] < 10) {
                        $studentArticle = "red";
                    } elseif ($student['average'] <= 13) {
                        $studentArticle = "orange";
                    } else {
                        $studentArticle = "green";
                    }
                    echo "<li>
                            <article class='$studentArticle'>
                                <header>
                                    <h1>{$student['firstName']} {$student['lastName']}</h1>
                                </header>
                                <section>
                                    <h2>Notes :</h2>
                                    <ul>";
                                        foreach ($student['grades'] as $grade) {
                                            echo "<li>{$grade}</li>";
                                        }
                    echo "      </ul>
                                </section>
                                <footer>
                                    <h3>Moyenne des notes de l'étudiant: {$student['average']}</h3>
                                </footer>
                            </article>
                        </li>";
                }
            ?>
        </ul>
    </body>
</html>



