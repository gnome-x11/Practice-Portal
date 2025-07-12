
<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../conn/conn.php';
require_once "../vendor/autoload.php";
require_once "../config.php";

require_once '../includes/header.php';
require_once '../jwt_validator.php';

use Firebase\JWT\JWT;

session_start();

$decoded = validateToken("admin_token", "admin_login.php");
$id = $decoded->uid;
$username = $decoded->username;

require '../includes/header.php';
require '../includes/admin_sidebar.php';


?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>TNHS Admin | Home</title>

</head>
<body>

</body>
</html>
