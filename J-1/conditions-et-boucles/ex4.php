<?php
$users = [
    [
        "firstName" => "Hugues",
        "lastName" => "Froger"
    ],
    [
        "firstName" => "Mari",
        "lastName" => "Doucet"
    ]
];


foreach ($users as $user) {
    echo $user["firstName"] . " " . $user["lastName"] . "<br>"; 
}
?>