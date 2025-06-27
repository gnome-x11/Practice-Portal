<?php
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

    <div class="d-flex justify-content-center align-items-center">
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
                <form class="form_control" method="" action="">
                    <div class="d-flex align-items-center mb-3">
                      <i class="fa-solid fa-user me-2 fs-5 text-secondary"></i>
                      <div class="form-floating flex-grow-1">
                        <input type="email" class="form-control" id="floatingInput" placeholder="LRN Number">
                        <label for="floatingInput">LRN Number</label>
                      </div>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                        <i class="fa-solid fa-lock me-2 fs-5 text-secondary"></i>
                        <div class="form-floating flex-grow-1">
                            <input type="password" class="form-control" id="floatingInput" placeholder="Pin Number">
                            <label for="floatingInput">Pin Number</label>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mx-auto mt-5">
                        <button class="btn btn-signin" type="button">Sign In</button>
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
</body>
</html>
