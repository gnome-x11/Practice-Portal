<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../conn/conn.php';
require_once "../vendor/autoload.php";
require_once '../jwt_validator.php';

use Firebase\JWT\JWT;

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    http_response_code(405);
    echo json_encode(['error' => "Method not allowed"]);
    exit;
}

$decoded = validateToken("admin_token", "admin_login.php");

function clean($key) {
    return isset($_POST[$key]) ? strtoupper(trim($_POST[$key])) : '';
}

$first_name = clean('first_name');
$middle_name = clean('middle_name');
$last_name = clean('last_name');

$age = intval($_POST['age'] ?? 0);
$birthday = clean('birthday');
$contact = clean('contact_number');
$email = clean('email');

$region = clean('region');
$province = clean('province');
$city = clean('city');
$barangay = clean('barangay');

$house = clean('house_number');
$street = clean('street_name');
$zipcode = clean('zip_code');

$employee_no = $_POST['employee_number'] ?? uniqid("EMP");
$department = clean('department');
$password = password_hash($_POST['password'] ?? "admin123", PASSWORD_DEFAULT);

$check = $conn->prepare("SELECT 1 FROM faculty WHERE email = ? OR employee_no = ?");
$check->execute([$email, $employee_no]);
if ($check->fetch()) {
    http_response_code(409);
    echo json_encode(['error' => 'Faculty with this email or employee number already exists']);
    exit;
}

$img_path = null;
if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === 0) {
    $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
    if (!in_array($_FILES['profile_image']['type'], $allowed_types)) {
        http_response_code(400);
        echo json_encode(['error' => "Only JPG and PNG images are allowed"]);
        exit;
    }

    $upload_dir = __DIR__ . '/../files/uploads/faculty_profile/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    $file_name = uniqid() . "_" . basename($_FILES['profile_image']['name']);
    $target_file = $upload_dir . $file_name;

    if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file)) {
        $img_path = 'files/uploads/faculty_profile/' . $file_name;
    } else {
        http_response_code(500);
        echo json_encode(['error' => "Image upload failed"]);
        exit;
    }
}

try {
    $level = 'Junior High School';

    $stmt = $conn->prepare("INSERT INTO faculty (
        first_name, middle_name, last_name, age, birthday, contact, email,
        region, province, city, barangay, house_no, street, zipcode,
        employee_no, department, level, password, profile_image
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->execute([
        $first_name, $middle_name, $last_name, $age, $birthday, $contact, $email,
        $region, $province, $city, $barangay, $house, $street, $zipcode,
        $employee_no, $department, $level, $password, $img_path
    ]);

    echo json_encode(['success' => true, 'message' => 'Faculty added successfully']);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Database error',
        'details' => $e->getMessage()
    ]);
}
