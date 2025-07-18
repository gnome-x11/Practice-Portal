<?php
require_once '../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function getBearerToken() {
    $headers = apache_request_headers();

    if (isset($headers['Authorization'])) {
        if (preg_match('/Bearer\s(\S+)/', $headers['Authorization'], $matches)) {
            return $matches[1];
        }
    }

    return null;
}

function validateBearer() {
    $publicKey = file_get_contents(__DIR__ . '/keys/public_key.pub');
    $token = getBearerToken();

    if (!$token) {
        http_response_code(401);
        echo json_encode(['error' => "No Token Provided"]);
        exit;
    }

    try {
        $decoded = JWT::decode($token, new Key($publicKey, 'RS256'));
        return $decoded;
    } catch (Exception $e) {
        http_response_code(401);
        echo json_encode(['error' => "Invalid or expired Token"]);
        exit;
    }
}


?>
