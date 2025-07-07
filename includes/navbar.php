<?php
    include '../includes/header.php';
    include '../includes/topbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Tunasan National High School - Main Page</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg p-2">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
          <img class="logo" src="../assets/img/tunasan_logo.svg" alt="Tunasan Logo">
        </a>

        <ul class="nav justify-content-end" id="navbar">
            <li class="nav-item">
                <a class="nav-link active" href="../index.php">Home</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="*" href="#" role="button" aria-expanded="false">School Profile</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="../pages/history.php">History</a></li>
                  <li><a class="dropdown-item" href="../pages/faculty.php">Faculty</a></li>
                  <li><a class="dropdown-item" href="../pages/academic_officials.php">Academic Officials</a></li>
                  <li><a class="dropdown-item" href="../pages/vision_mission.php">Tunasan Vision and Mission</a></li>
                  <li><a class="dropdown-item" href="../pages/student_organization.php">Students Organization</a></li>
                  <li><a class="dropdown-item" href="../pages/student_club.php">Student Clubs</a></li>
                  <li><a class="dropdown-item" href="../pages/organizational_chart">Organizational Structure</a></li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="*" href="#" role="button" aria-expanded="false">Online Services</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="../pages/online_admission_junior.php">Online Addmission (Junior High School)</a></li>
                  <li><a class="dropdown-item" href="../pages/online_admission_senior.php">Online Addmission (Senior High School)</a></li>
                  <li><a class="dropdown-item" href="../pages/online_admission_als.php">Alternative Learning System (ALS)</a></li>
                  <li><a class="dropdown-item" href="../student_portal/student_portal.php">Student Portal</a></li>
                  <li><a class="dropdown-item" href="../faculty_portal/faculty_portal.php">Faculty Portal</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="../pages/admission_procedures.php">Admission Requirements and Procedures</a></li>
                  <li><a class="dropdown-item" href="../pages/strand_offered.php">Senior High School Offered Strand</a></li>
                </ul>
              </li>

          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="../pages/carrers.php">Carrers</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../pages/academics.php">Academics</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../pages/contact_us.php">Contact Us</a>
          </li>
        </ul>

        <div class="menu_icon">
            <i class="fa-solid fa-bars me-2" onclick="toggleMenu()"></i>
        </div>

      </div>
    </nav>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>
