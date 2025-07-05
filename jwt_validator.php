<?php

require_once "../conn/conn.php";
require_once "../vendor/autoload.php";
require_once "../config.php";

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function validateToken ( $cookieName, $redirectURL = "login.php") {
    $secret_key = JWT_SECRET_KEY;

    if (!isset($_COOKIE[$cookieName])) {
        header("Location: $redirectURL");
        exit();
    }

    try{
        $decoded = JWT::decode($_COOKIE[$cookieName], new Key($secret_key, 'HS256'));
        return $decoded;
    } catch (Exception $e) {
        header("Location: $redirectURL");
        exit ();
    }
}
?>
