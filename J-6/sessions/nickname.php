<?php
session_start();
if (isset($_POST['pseudo'])) {
    $_SESSION['pseudo'] = htmlspecialchars($_POST['pseudo']);
    header('Location: welcome.php');
    exit();
}
?>