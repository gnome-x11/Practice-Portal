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
            <form class="form_control" id="loginForm">
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

<script>
    document.getElementById("loginForm").addEventListener("submit", function (e) {
        e.preventDefault();

    const username = document.querySelector("input[name='username']").value.trim();
    const password = document.querySelector("input[name='password']").value.trim();

    fetch("../api/login_api.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({username, password})
    })

    .then(res=>res.json())
    .then(data => {
        if (data.success) {
            window.location.href = 'dashboard.php';
        } else {
            alert(data.error);
        }
    })

    .catch(err => {
        console.error("Login error:", err);
        alert("Something went wrong");
    });

});
</script>

</body>
</html>
