<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

require_once '../conn/conn.php';
require_once '../vendor/autoload.php';
require_once '../config.php';

use Firebase\JWT\JWT;

$secret_key = JWT_SECRET_KEY;

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lrn_number = trim($_POST['lrn_number']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM student_portal WHERE lrn_number = ?");
    $stmt->bind_param("s", $lrn_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows == 1){
        $student_portal = $result->fetch_assoc();

        if (password_verify($password, $student_portal['password'])) {
            $issuedAt = time();
            $expire = $issuedAt + (60 * 60);

            $payload = [
                'iat' => $issuedAt,
                'expire' => $expire,
                'uid' => $student_portal['id'],
                'lrn_number' => $student_portal['lrn_number']
            ];

            $jwt = JWT::encode($payload, $secret_key, 'HS256');

            setcookie("student_token", $jwt, [
                'expires'=> $expire,
                'httponly' => true,
                'samesite' => 'Strict',
                'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'
            ]);

            header("Location: home.php");
            exit;
        }
    }
    $error = "Invalid Credentials";
}

include_once '../includes/header.php';
include_once '../includes/topbar.php';
include_once '../includes/navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>TNHS - Student Portal</title>
</head>
<body>

    <div class="container-body">
            <div class="card">
            <div class="d-flex align-items-center">
                <img class="card_logo" src="../assets/img/small_logo.png">
                <div class="subtitle">
                    <h1 class="text-dark">
                        <i class="fa-outline fa-lock me-2"></i>
                        THNS Student Portal
                        <p class="fw-light fst-italic mt-2">Please fill all fields</p>
                    </h1>
                </div>
            </div>
            <hr class="text-success">
                <div class="container">

                <form class="form_control" method="POST" action="">
                    <div class="d-flex align-items-center mb-3">
                      <i class="fa-solid fa-user me-2 fs-5 text-secondary"></i>
                      <div class="form-floating flex-grow-1">
                        <input type="text" class="form-control" id="floatingInput" placeholder="LRN Number" name="lrn_number">
                        <label for="floatingInput">LRN Number</label>
                      </div>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                        <i class="fa-solid fa-lock me-2 fs-5 text-secondary"></i>
                        <div class="form-floating flex-grow-1">
                            <input type="password" class="form-control" id="floatingInput" placeholder="Pin Number" name="password">
                            <label for="floatingInput">Pin Number</label>
                        </div>
                    </div>

                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger" id="error_alert"><?=htmlspecialchars($error)?></div>
                    <?php endif?>

                    <div class="d-grid gap-2 mx-auto mt-5">
                        <button class="btn btn-signin"  name="submit">Sign In</button>
                    </div>
                </form>
                </div>
            <hr class="text-success">
            <div class="error d-flex align-items-center mb-3">
                <p class="fw-normal fst-italic fs-14">
                    If you forgot your PIN or need an assistance to <br>
                    activate your account, please email us at <br>
                    <span class="text-success"><a href="mailto:tnhs_support@gmail.com">tnhs_support@gmail.com
                    </a></span> using your official IE <br>account.
                    We will only entertain messages coming <br>
                    from THNS email only.
                </p>
            </div>
        </div>
    </div>

    <script>
    setTimeout(() => {
        document.getElementById('error_alert').style.display = 'none';
    },
        1000
    );
    </script>
</body>
</html>
