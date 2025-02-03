<?php
require '../../vendor/autoload.php';

// Debug
error_reporting(E_ALL);
ini_set("display_errors", 1);

// Charger les variables d’environnement
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../config');
$dotenv->load();

// Initialisation du client Stripe
$stripe = new \Stripe\StripeClient($_ENV['STRIPE_SECRET_KEY']);

/**
 * Calculer le montant en centimes
 */
function calculateOrderAmount(int $amount): int
{
    return max(100, $amount * 100);
}

// Réponse JSON
header('Content-Type: application/json');

try {
    $jsonStr = file_get_contents('php://input');
    $jsonObj = json_decode($jsonStr);

    if (!isset($jsonObj->amount) || !is_numeric($jsonObj->amount) || $jsonObj->amount < 1) {
        throw new Exception("Montant invalide : " . json_encode($jsonObj));
    }

    $paymentIntent = $stripe->paymentIntents->create([
        'amount' => calculateOrderAmount((int)$jsonObj->amount),
        'currency' => 'eur',
        'payment_method_types' => ['card'],
    ]);

    echo json_encode(['clientSecret' => $paymentIntent->client_secret]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
