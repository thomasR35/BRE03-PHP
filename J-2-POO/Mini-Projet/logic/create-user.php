<?php

require __DIR__ . '/../managers/UserManager.class.php';

if(isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["role"]))
{
    $user = new User($_POST["username"], $_POST["email"], password_hash($_POST["password"], PASSWORD_BCRYPT), $_POST["role"]);

    $manager = new UserManager();

    $manager->saveUser($user);

    header("Location: ../index.php");
}