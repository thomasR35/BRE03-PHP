<?php
$user = [
    "name" => "James",
    "age" => 28
];

foreach ($user as $key => $value) {
    if ($key == "name") {
        echo "My name is $value.<br>"; 
    } elseif ($key == "age") {
        echo "My age is $value.<br>"; 
    }
}
?>