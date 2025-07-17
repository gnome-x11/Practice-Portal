<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../conn/conn.php";
require_once "../vendor/autoload.php";
require_once "../config.php";

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function validateToken ( $cookieName, $redirectURL = "login.php") {

    $publicKey = file_get_contents(__DIR__ . '/keys/public_key.pub');

    if (!isset($_COOKIE[$cookieName])) {
        header("Location: $redirectURL");
        exit();
    }

    try{
        $decoded = JWT::decode($_COOKIE[$cookieName], new Key($publicKey, 'RS256'));
        return $decoded;
    } catch (Exception $e) {
        header("Location: $redirectURL");
        exit ();
    }
}
?>
