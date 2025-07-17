<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../conn/conn.php';
require_once "../vendor/autoload.php";
require_once "../config.php";
require_once '../includes/header.php';

use Firebase\JWT\JWT;

$privateKey = file_get_contents((dirname(__DIR__) . '/keys/private_key.pem'));

$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    $stmt = $pdo->prepare("SELECT * FROM admin WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin && password_verify($password, $admin["password"])) {
            $issued_At = time();
            $expire = $issued_At + (60 * 60);

            $payload = [
                'iat' => $issued_At,
                'exp' => $expire,
                'uid' => $admin['id'],
                'username' => $admin['username']
            ];

            $jwt = JWT::encode($payload, $privateKey, 'RS256');

            setcookie("admin_token", $jwt, [
                'expires' => $expire,
                'httponly' => true,
                'samesite' => 'Strict',
                'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' // Avoid issues in localhost
            ]);

            header("Location: dashboard.php");
            exit;
        }
    $error = "Invalid credentials";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>TNHS - Student Portal</title>
	<link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico">
</head>
<body>

<div class="container-body" style="margin-top: 60px;">
    <div class="card">
        <div class="d-flex align-items-center">
            <img class="card_logo" src="../assets/img/small_logo.png">
            <div class="subtitle">
                <h1 class="text-dark">
                    <i class="fa-outline fa-lock me-2"></i>
                    THNS Admin Moderator
                </h1>
            </div>
        </div>
        <hr class="text-success">

        <div class="container">
            <form class="form_control" method="POST" action="">
                <div class="d-flex align-items-center mb-3">
                    <i class="fa-solid fa-user me-2 fs-5 text-secondary"></i>
                    <div class="form-floating flex-grow-1">
                        <input type="text" class="form-control" id="floatingInput" placeholder="Username" name="username" required>
                        <label for="floatingInput">Username</label>
                    </div>
                </div>

                <div class="d-flex align-items-center mb-3">
                    <i class="fa-solid fa-lock me-2 fs-5 text-secondary"></i>
                    <div class="form-floating flex-grow-1">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required>
                        <label for="floatingPassword">Password</label>
                    </div>
                </div>

                <?php if (!empty($error)): ?>
                <div class="alert alert-danger alert-dismissable fade-shadow" role="alert">
                    <strong><?=htmlspecialchars($error)?></strong> Please Try Again.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php endif?>

                <div class="d-grid  mx-auto mt-2">
                    <button class="btn btn-signin btn-lg" type="submit">Sign In</button>
                </div>

            </form>
        </div>

        <hr class="text-success">
        <div class="error d-flex align-items-center mb-3">
            <p class="fw-normal fst-italic fs-14">
                If you forgot your PIN or need assistance to <br>
                activate your account, please email us at <br>
                <span class="text-success">
                    <a href="mailto:tnhs_support@gmail.com">tnhs_support@gmail.com</a>
                </span> using your official IE account.<br>
                We will only entertain messages coming <br>
                from THNS email only.
            </p>
        </div>
    </div>
</div>

</body>
</html>
