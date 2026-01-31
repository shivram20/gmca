<?php
header("Content-Type: application/json; charset=UTF-8");
include("../connection.php");

/* Read JSON input */
$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);

/* Check valid JSON */
// if (!$data) {
//     echo json_encode([
//         "status" => "error",
//         "message" => ""
//     ]);
//     exit;
// }

$fullname  = trim($data["fullname"] ?? "");
$email     = trim($data["email"] ?? "");
$password  = $data["password"] ?? "";
$cpassword = $data["cpassword"] ?? "";
$phone     = trim($data["phone"] ?? "");

if ($fullname === "" || $email === "" || $password === "" || $phone === "") {
    echo json_encode([
        "status" => "error",
        "message" => "All fields are required"
    ]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid email format"
    ]);
    exit;
}

/* Password match */
if ($password !== $cpassword) {
    echo json_encode([
        "status" => "error",
        "message" => "Passwords do not match"
    ]);
    exit;
}

/* Password strength (optional but recommended) */
if (strlen($password) < 6) {
    echo json_encode([
        "status" => "error",
        "message" => "Password must be at least 6 characters"
    ]);
    exit;
}

/* ✅ Phone validation (India – 10 digits) */
if (!preg_match("/^[6-9][0-9]{9}$/", $phone)) {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid phone number"
    ]);
    exit;
}

/* Check email exists */
$stmt = $conn->prepare("SELECT user_id FROM users WHERE user_email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo json_encode([
        "status" => "error",
        "message" => "Email already registered"
    ]);
    exit;
}
$stmt->close();

/* Check phone exists */
$stmt = $conn->prepare("SELECT user_id FROM users WHERE user_phone = ?");
$stmt->bind_param("s", $phone);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo json_encode([
        "status" => "error",
        "message" => "Phone number already registered"
    ]);
    exit;
}
$stmt->close();

/* Hash password */
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

/* Insert user */
$stmt = $conn->prepare(
    "INSERT INTO users (user_name, user_email, user_password, user_phone)
     VALUES (?, ?, ?, ?)"
);
$stmt->bind_param("ssss", $fullname, $email, $hashedPassword, $phone);

if ($stmt->execute()) {
    echo json_encode([
        "status" => "success",
        "message" => "Registration successful"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Database error"
    ]);
}

$stmt->close();
$conn->close();
?>
