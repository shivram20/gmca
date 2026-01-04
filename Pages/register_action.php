<?php
header("Content-Type: application/json");
include("../connection.php");

// Read raw input
$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);

// Get data
$fullname = $data["fullname"];
$email = $data["email"];
$password = $data["password"];
$phone = $data["phone"];


if(empty($fullname) || empty($email) || empty($password) || empty($phone)){
    echo json_encode([
        "status" => "error",
        "message" => "All fields are required"
    ]);
    exit;
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    echo json_encode([
        "status" => "error",
        "message" => "Invalid email address"
    ]);
    exit;
}

if($password != $data["cpassword"]){
    echo json_encode([
        "status" => "error",
        "message" => "Passwords do not match"
    ]);
    exit;
}

if($phone < 1000000000 || $phone > 9999999999){
    echo json_encode([
        "status" => "error",
        "message" => "Invalid phone number"
    ]);
    exit;
}

// Email exists check
$check = mysqli_query($conn, "SELECT user_id FROM users WHERE user_email='$email'");
if (mysqli_num_rows($check) > 0) {
    echo json_encode([
        "status" => "error",
        "message" => "Email already registered"
    ]);
    exit;
}


// check phone number
$check = mysqli_query($conn, "SELECT user_id FROM users WHERE user_phone='$phone'");
if (mysqli_num_rows($check) > 0) {
    echo json_encode([
        "status" => "error",
        "message" => "Phone number already registered"
    ]);
    exit;
}

// Hash password
$hashedPassword = password_hash($password, PASSWORD_BCRYPT);

// Insert
$sql = "INSERT INTO users (user_name, user_email, user_password, user_phone)
        VALUES ('$fullname', '$email', '$hashedPassword', '$phone')";

if (mysqli_query($conn, $sql)) {
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
?>
