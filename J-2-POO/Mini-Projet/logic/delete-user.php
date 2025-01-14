<?php

require __DIR__ . '/../managers/UserManager.class.php';

if(isset($_GET["id"]))
{
    $manager = new UserManager();
    $user = new User("", "", "", "");
    $user->setId(intval($_GET["id"]));

    $manager->deleteUser($user);

    header("Location: ../index.php");
}



