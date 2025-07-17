<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

require_once '../conn/conn.php';
require_once '../vendor/autoload.php';
require_once '../config.php';
require_once '../jwt_validator.php';

use Firebase\JWT\JWT;

session_start();

$decoded = validateToken("faculty_token", "faculty_portal.php");
$id = $decoded->uid;
$employee_number = $decoded->employee_number;

include_once '../includes/header.php';
include_once '../includes/navbar.php';
?>
