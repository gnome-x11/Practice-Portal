<?php
    include __DIR__ . '/header.php';
    include __DIR__ . '/topbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

    <nav class="navbar navbar-expand-lg p-2" id="myTopnav">
      <div class="container-fluid">
        <a class="navbar-brand" href="">
          <img class="logo" src="../assets/img/admin_logo.svg" alt="Tunasan Logo">
        </a>

        <ul class="nav justify-content-end" id="navbar">
            <li class="nav-item">
                <a class="nav-link active" href="dashboard.php">Home</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="*" href="#" role="button" aria-expanded="false">Manage Faculty Account</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="junior_high_school_faculty.php">Junior High School Faculty</a></li>
                  <li><a class="dropdown-item" href="senior_high_school_faculty.php">Senior High School Faulty</a></li>

                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="*" href="admin/" role="button" aria-expanded="false">Manage Students</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="junior_high_admission.php">Online Addmission (Junior High School) Application</a></li>
                  <li><a class="dropdown-item" href="senior_high_admission.php">Online Addmission (Senior High School) Application</a></li>
                  <li><a class="dropdown-item" href="als_admission.php">Alternative Learning System (ALS) Application</a></li>
                  <li><a class="dropdown-item" href="student_account_recovery.php">Student Account Recovery </a></li>

                </ul>
              </li>

              <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="*" href="" role="button" aria-expanded="false">Manage Content</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="announcement.php">Announcement</a></li>
                    <li><a class="dropdown-item" href="job_offer.php">Job Offers</a></li>
                    <li><a class="dropdown-item" href="student_organization.php">Student Organization</a></li>
                    <li><a class="dropdown-item" href="student_club.php">Student Clubs</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="">Admission Requirements and Procedures</a></li>
                    <li><a class="dropdown-item" href="">Senior High School Offered Strand</a></li>
                  </ul>
                </li>

          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="job_applications.php">Job Applications</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="inquiries.php">Inquires</a>
          </li>
        </ul>

        <div class="menu_icon">
            <i class="fa-solid fa-bars me-2" onclick="toggleMenu()"></i>
        </div>

      </div>

      <div class="topbar-controls">
        <div class="dropdown">
            <div class="user-menu" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="user-avatar">
                    <?php
                    $admin_initial = !empty($_SESSION['admin']) ? strtoupper(substr($_SESSION['username'], 0, 1)) : 'A';
                    echo $admin_initial;
                    ?>
                </div>
                <div class="user-info d-none d-xl-block">

                </div>
                <i class="bi bi-chevron-down d-none d-xl-block"></i>
            </div>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="account_management.php"><i class="bi bi-person"></i> Profile</a></li>
                <li>
                </li>
                <li><a class="dropdown-item" href="../includes/logout.php"><i class="bi bi-box-arrow-right"></i>
                        Logout</a></li>
            </ul>
        </div>
    </nav>



    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/index.js"></script>

</body>
</html>
