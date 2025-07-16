
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
	<title>TNHS Admin | Manage Junior High Faculty</title>
</head>

<body>
    <div class="container p-4 mt-5">
        <div class="row">
            <div class="col-lg-10">
                <h2>Junior High School Faculty</h2>
            </div>
            <div class="col-lg-2">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addFacultyModal">Add Faculty</button>
                <button type="button" class="btn btn-danger btn-sm">Delete </button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addFacultyModal" tabindex="-1" aria-labelledby="addFacultyModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="addFacultyModal">Add Junior High Faculty</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
                <div class="input"
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>

</body>
</html>

<!--
TO BE ADDED IN THE MODAL

PHOTO:
FIRST NAME:
MIDDLE NAME:
LAST NAME:

ADDRESS:(use a js for address)

DEPARTMENT:
YEAR LEVEL:


-->
