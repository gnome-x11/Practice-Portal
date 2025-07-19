<?php

    require '../conn/conn.php';
    require '../vendor/autoload.php';
    require '../config.php';

    use Firebase\JWT\JWT;

    $privateKey = file_get_contents((dirname(__DIR__) . '/keys/private_key.pem'));

    $error = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $employee_no = trim($_POST['employee_no']);
        $password = trim($_POST['password']);

        $stmt = $conn->prepare("SELECT * FROM faculty WHERE employee_no = :employee_no");
        $stmt->execute(['employee_no' => $employee_no]);
        $faculty_portal = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($faculty_portal && password_verify($password, $faculty_portal['password'])) {
            $issued_at = time();
            $expire = $issued_at + (60 * 60);

            $payload = [
                'iat'=>$issued_at,
                'expires'=>$expire,
                'uid'=>$faculty_portal['fid'],
                'employee_no'=>$faculty_portal['employee_no']
            ];

            $jwt = JWT::encode($payload, $privateKey, 'RS256');

            setcookie("faculty_token", $jwt, [
                'expires'=>$expire,
                'httponly'=>true,
                'samesite'=>'Strict',
                'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'
            ]);

            header("Location: home.php");
            exit;
        }
    $error = 'Invalid Credentials';
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
	<title>Faculty Portal</title>
</head>

<body class="faculty_portal">
    <div class="d-flex justify-content-center align-items-center">
            <div class="card">
                <div class="d-flex align-items-center">
                <img class="card_logo" src="../assets/img/small_logo.png">
                <div class="subtitle">
                    <h1 class="text-dark">
                        <i class="fa-outline fa-lock me-2"></i>
                        THNS Faculty Portal
                    </h1>
                </div>
            </div>
            <hr class="text-dark">
                <div class="container">
                <form class="form_control" method="POST" action="">
                    <div class="d-flex align-items-center mb-3">
                      <i class="fa-solid fa-user me-2 fs-5 text-secondary"></i>
                      <div class="form-floating flex-grow-1">
                        <input type="text" class="form-control" id="floatingInput" placeholder="Employee Number" name="employee_no" required>
                        <label for="floatingInput">Employee Number</label>
                      </div>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                        <i class="fa-solid fa-lock me-2 fs-5 text-secondary"></i>
                        <div class="form-floating flex-grow-1">
                            <input type="password" class="form-control" id="floatingInput" placeholder="Pin Number" name="password" required>
                            <label for="floatingInput">Pin Number</label>
                        </div>
                    </div>

                    <?php if (!empty($error)): ?>
                    <div class="alert alert-danger alert-dismissable fade-shadow" role="alert">
                        <strong><?=htmlspecialchars($error)?></strong> Please Try Again.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php endif?>

                    <div class="d-grid gap-2  mx-auto mt-5">
                        <button class="btn btn-signin bht-lg" name="submit">Sign In</button>
                    </div>
                </form>
                </div>
            <hr class="text-success">
            <div class="error d-flex align-items-center mb-3 text-dark">
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
</body>
</html>
