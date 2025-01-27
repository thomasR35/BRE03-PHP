<?php

/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class CSRFTokenManager
{
    public function generateCSRFToken(): string
    {
        return bin2hex(random_bytes(32));
    }

    public function validateCSRFToken(string $token): bool
    {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
}
