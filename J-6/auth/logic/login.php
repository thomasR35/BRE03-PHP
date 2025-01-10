<?php

require '../connexion.php'; 

if (isset($_POST['email'], $_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (isset($db)) {
        $query = $db->prepare("SELECT * FROM users WHERE email = ?");
        
        $query->execute([$email]);

        $user = $query->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user'] = [
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name']
                ];

                header('Location: ../index.php?route=home');
                exit;
            } else {
                
                echo '<h1>Mot de passe incorrect</h1>';
            }
        } else {
            echo '<h1>Email incorrect</h1>';
        }
    } else {
        echo '<h1>Erreur de connexion à la base de données.</h1>';
    }
}
?>
