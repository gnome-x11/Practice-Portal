
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

<?php
    $junior_faculty = $conn->query("SELECT COUNT(*) as total FROM faculty_portal WHERE position = 'junior_high'")->fetch_assoc()["total"];
    $senior_faculty = $conn->query("SELECT COUNT(*) as total FROM faculty_portal WHERE position = 'senior_high'")->fetch_assoc()["total"];
    $junior_students = $conn->query("SELECT COUNT(*) as total FROM student_portal WHERE level = 'junior_high'")->fetch_assoc()["total"];
    $senior_students = $conn->query("SELECT COUNT(*) as total FROM student_portal WHERE level = 'senior_high'")->fetch_assoc()["total"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>TNHS Admin | Home</title>
</head>

<body>
    <div class="mamao">
        <div class="row">
            <div class="col-lg-3 col-sm-6">
                <div class="card-box bg-blue">
                    <div class="inner">
                        <h3><?php echo $junior_students?></h3>
                        <p>Junior High School Faculty</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-chalkboard-user" aria-hidden="true"></i>
                    </div>
                    <a href="#" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-sm-6">
                <div class="card-box bg-green">
                    <div class="inner">
                        <h3><?php echo $senior_students ?></h3>
                        <p>Senior High School Faculty</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-chalkboard-user" aria-hidden="true"></i>
                    </div>
                    <a href="#" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card-box bg-orange">
                    <div class="inner">
                        <h3><?php echo $junior_faculty?></h3>
                        <p>Junior High School Students</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users" aria-hidden="true"></i>
                    </div>
                    <a href="#" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6">
                <div class="card-box bg-red">
                    <div class="inner">
                        <h3><?php echo $senior_faculty?></h3>
                        <p>Senior High School Students</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="#" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

        </div>
    </div>
</body>
</html>
