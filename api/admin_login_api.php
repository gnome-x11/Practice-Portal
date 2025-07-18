<?php

require_once '../conn/conn.php';
require_once "../vendor/autoload.php";
require_once "../config.php";

use Firebase\JWT\JWT;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    http_response_code(405);
    echo json_encode(['error' => "Method not allowed"]);
    exit;
}

$input = json_decode(file_get_contents("php://input"), true);
$username = trim($input['username'] ?? '');
$password = trim($input['password'] ?? '');

if (!$username || !$password) {
    echo json_encode(['error' => "Missing Username or password"]);
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM admin WHERE username = :username");
$stmt->execute(['username' => $username]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

if ($admin && password_verify($password, $admin['password'])) {
    $privateKey = file_get_contents(dirname(__DIR__) . '/keys/private_key.pem');
    $issued_At = time();
    $expires = $issued_At + (60 * 60);

    $payload = [
        'iat' => $issued_At,
        'exp' => $expires,
        'uid' => $admin['id'],
        'username' => $admin['username']
    ];

    $jwt = JWT::encode($payload, $privateKey, 'RS256');

    setcookie("admin_token", $jwt, [
        'expires' => $expires,
        'path' => '/',
        'httponly' => true,
        'samesite' => 'Strict',
        'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'
    ]);

    echo json_encode(['success' => true]);
    exit;
}

echo json_encode(['error' => 'Invalid Credentials.']);
