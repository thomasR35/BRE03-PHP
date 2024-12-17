<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email'])) {
        $email = htmlspecialchars($_POST['email']);
    } else {
        $email = '';
    }

    if (isset($_POST['password'])) {
        $password = htmlspecialchars($_POST['password']);
    } else {
        $password = '';
    }

    if (isset($_POST['confirm_password'])) {
        $confirmPassword = htmlspecialchars($_POST['confirm_password']);
    } else {
        $confirmPassword = '';
    }

    if (isset($_POST['newsletter'])) {
        $newsletter = true;
    } else {
        $newsletter = false;
    }

    if ($password === $confirmPassword) {
        $passwordCheck = "OK";
    } else {
        $passwordCheck = "NOK";
    }

    if ($newsletter) {
        $newsletterStatus = "Oui";
    } else {
        $newsletterStatus = "Non";
    }
} else {
    $email = null;
    $password = null;
    $confirmPassword = null;
    $passwordCheck = null;
    $newsletterStatus = null;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultat du formulaire d'inscription</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
        }
        h1 {
            color: #333;
        }
        .result {
            margin-top: 20px;
        }
        .status-ok {
            color: green;
        }
        .status-nok {
            color: red;
        }
        .info {
            background: #f9f9f9;
            border: 1px solid #ddd;
            padding: 10px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Résultat du formulaire d'inscription</h1>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <div class="result">
            <p><strong>Vérification des mots de passe :</strong> 
                <?php 
                    if ($passwordCheck === 'OK') {
                        echo '<span class="status-ok">' . $passwordCheck . '</span>';
                    } else {
                        echo '<span class="status-nok">' . $passwordCheck . '</span>';
                    }
                ?>
            </p>
            <div class="info">
                <p><strong>Email :</strong> <?= $email ?></p>
                <p><strong>Mot de passe :</strong> <?= $password ?></p>
                <p><strong>Newsletter :</strong> <?= $newsletterStatus ?></p>
            </div>
        </div>
    <?php else: ?>
        <p>Aucune donnée reçue.</p>
    <?php endif; ?>
</body>
</html>

