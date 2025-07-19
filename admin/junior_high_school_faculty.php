<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../conn/conn.php';
require_once "../vendor/autoload.php";
require_once "../config.php";

require_once '../includes/header.php';
require '../includes/header.php';
require_once '../jwt_validator.php';

use Firebase\JWT\JWT;

session_start();

$decoded = validateToken("admin_token", "admin_login.php");
$id = $decoded->uid;
$username = $decoded->username;

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
        <button type="button" id="addjunior" class="btn btn-primary btn-sm" data-bs-toggle="modal"
          data-bs-target="#addFacultyModal">Add Faculty</button>
        <button type="button" class="btn btn-danger btn-sm">Delete</button>
      </div>
    </div>
  </div>

  <div class="modal fade" id="addFacultyModal" tabindex="-1" aria-labelledby="addFacultyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="addFacultyModalLabel">Add Junior High Faculty</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <div class="row p-4">

            <div class="col-4">
              <img class="d-flex mx-auto mt-4 mb-4" id="output" style="width: 200px; height: 200px; border: none;" />
              <input type="file" name="fileUpload" id="fileUpload" accept="image/*" onchange="loadFile(event)" class="form-control mb-4">
            </div>

            <div class="col-lg-8 col-md-12">
              <div class="form-group mb-4">
                <div class="row form-group">
                  <div class="form-header col-md-12 mb-4">
                    <h4 class="form-header-title">Personal Information</h4>
                  </div>

                  <div class="col-md-4 mb-2">
                    <label class="control-label">First Name</label>
                    <input type="text" name="firstName" class="form-control" required autocomplete="given-name" oninput="this.value = this.value.toUpperCase()">
                  </div>

                  <div class="col-md-4 mb-2">
                    <label class="control-label">Middle Name</label>
                    <input type="text" name="middleName" class="form-control" required autocomplete="additional-name" oninput="this.value = this.value.toUpperCase()">
                  </div>

                  <div class="col-md-4 mb-2">
                    <label class="control-label">Last Name</label>
                    <input type="text" name="lastName" class="form-control" required autocomplete="family-name" oninput="this.value = this.value.toUpperCase()">
                  </div>
                </div>

                <div class="row col-12 mt-2">
                  <div class="col-6 mb-2">
                    <label class="control-label">Age</label>
                    <input type="number" name="age" class="form-control" required>
                  </div>

                  <div class="col-md-6 mb-2">
                    <label class="control-label">Birthday</label>
                    <input type="date" name="birthday" class="form-control" required autocomplete="bday">
                  </div>

                  <div class="col-md-6 mt-2">
                    <label class="control-label">Contact Number</label>
                    <input type="tel" name="contactNumber" class="form-control" pattern="^(09|\+639)\d{9}$" autocomplete="tel" required>
                  </div>

                  <div class="col-md-6 mt-2">
                    <label class="control-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-12">
              <div class="form-header col-md-12">
                <h6 class="form-header-title fw-normal">Address</h6>
                <hr />
              </div>

              <div class="row col-12">
                <div class="col-6 mb-2">
                  <label for="region" class="form-label">Region</label>
                  <select class="form-select p-2" id="region" name="region">
                    <option selected value="">Please Select a Region First</option>
                  </select>
                </div>

                <div class="col-6 mb-2">
                  <label for="province" class="form-label">Province</label>
                  <select name="province" class="form-select p-2" id="province"></select>
                </div>
              </div>

              <div class="row col-12 mb-2">
                <div class="col-6">
                  <label for="city" class="form-label">City / Municipality</label>
                  <select name="city" class="form-select p-2" id="city"></select>
                </div>

                <div class="col-6 mb-2">
                  <label for="barangay" class="form-label">Barangay</label>
                  <select name="barangay" class="form-select p-2" id="barangay"></select>
                </div>
              </div>

              <div class="row col-12">
                <div class="col-3 mb-2">
                  <label class="control-label">House/Building No.</label>
                  <input type="text" name="houseNumber" class="form-control" oninput="this.value = this.value.toUpperCase()">
                </div>

                <div class="col-5 mb-2">
                  <label class="control-label">Street Name</label>
                  <input type="text" name="streetName" class="form-control" oninput="this.value = this.value.toUpperCase()">
                </div>

                <div class="col-4 mb-2">
                  <label class="control-label">Zip Code</label>
                  <input type="text" name="zipCode" class="form-control">
                </div>
              </div>
            </div>

            <div class="col-12 p-4">
              <hr />
              <div class="form-header col-md-12 mb-4">
                <h4 class="form-header-title">Faculty Information</h4>
              </div>

              <div class="row col-12">
                <div class="col-6 mb-2">
                  <label class="control-label">Employee Number</label>
                  <p class="text-body-tertiary fw-light fst-italic mb-2 fs-6">Auto-generated employee number.<span class="text-danger">*</span></p>
                  <input type="text" name="employeeNumber" id="employeeNumber" class="form-control" readonly>
                </div>

                <div class="col-6 mb-2">
                  <label for="department" class="form-label">Department</label>
                  <select name="department" id="department" class="form-select p-2" required>
                    <option value="" disabled selected>Select Department</option>
                    <option value="MAPEH">MAPEH Department</option>
                    <option value="Science">Science Department</option>
                    <option value="Filipino">Filipino Department</option>
                    <option value="Math">Mathematics Department</option>
                    <option value="English">English Department</option>
                    <option value="TLE">TLE Department</option>
                    <option value="ESP">ESP Department</option>
                  </select>
                </div>
              </div>

              <div class="row col-12 mt-4">
                <div class="form-header col-md-12 mb-4">
                  <h6 class="form-header-title">Account Information</h6>
                </div>

                <div class="col-6">
                  <label class="control-label">Password</label>
                  <p class="text-body-tertiary fw-light fst-italic mb-2 fs-6">Leave blank for default password.<span class="text-danger">*</span></p>
                  <input type="password" name="password" class="form-control text-muted" value="admin123">
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" id="submitFaculty" class="btn btn-success">Create Account</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.getElementById('submitFaculty').addEventListener('click', async function () {
      const formData = new FormData();

      const empNumber = "EMP" + Date.now();
      document.getElementById('employeeNumber').value = empNumber;

      formData.append('first_name', document.querySelector('input[name="firstName"]').value);
      formData.append('middle_name', document.querySelector('input[name="middleName"]').value);
      formData.append('last_name', document.querySelector('input[name="lastName"]').value);
      formData.append('age', document.querySelector('input[name="age"]').value);
      formData.append('birthday', document.querySelector('input[name="birthday"]').value);
      formData.append('contact_number', document.querySelector('input[name="contactNumber"]').value);
      formData.append('email', document.querySelector('input[name="email"]').value);
      formData.append('region', document.querySelector('#region').value);
      formData.append('province', document.querySelector('#province').value);
      formData.append('city', document.querySelector('#city').value);
      formData.append('barangay', document.querySelector('#barangay').value);
      formData.append('house_number', document.querySelector('input[name="houseNumber"]').value);
      formData.append('street_name', document.querySelector('input[name="streetName"]').value);
      formData.append('zip_code', document.querySelector('input[name="zipCode"]').value);
      formData.append('employee_number', empNumber);
      formData.append('department', document.querySelector('#department').value);
      formData.append('password', document.querySelector('input[name="password"]').value);

      const fileInput = document.querySelector('#fileUpload');
      if (fileInput && fileInput.files.length > 0) {
        formData.append('profile_image', fileInput.files[0]);
      }

      try {
        const res = await fetch('../api/add_junior_faculty_api.php', {
          method: "POST",
          body: formData,
          credentials: 'include'
        });

        const data = await res.json();

        if (data.success) {
          alert("Added Successfully");
          location.reload();
        } else {
          console.error("Server response:", data);
          alert("Error: " + (data.message || data.error || "Unknown error"));
        }

      } catch (err) {
        alert("Something went wrong.");
      }
    });
    </script>
    <script>

    var loadFile = function (event) {
      var output = document.getElementById('output');
      output.src = URL.createObjectURL(event.target.files[0]);
      output.onload = function () {
        URL.revokeObjectURL(output.src);
      }
    };
  </script>

  <script src="../assets/js/handler.js" defer></script>
</body>

</html>
