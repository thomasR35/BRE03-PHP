<?php

// Génère un jeton CSRF et le stocke en session
function generateCsrfToken(): string
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $token = bin2hex(random_bytes(32));
    $_SESSION['csrf_token'] = $token;

    return $token;
}

// Vérifie si le token CSRF est valide
function verifyCsrfToken(): bool
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    return isset($_POST['csrf_token'], $_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $_POST['csrf_token']);
}

// Protège contre les attaques XSS en nettoyant les données utilisateur
function sanitize(string $data): string
{
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

// Valide la complexité du mot de passe
function validatePassword(string $password): bool
{
    $pattern = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/';
    return preg_match($pattern, $password) === 1;
}
