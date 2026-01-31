<?php
session_start();
header("Content-Type: application/json; charset=UTF-8");
include("../connection.php");

/* Read JSON input */
$rawData = file_get_contents("php://input");
$data = json_decode($rawData, true);

// /* Validate JSON */
// if (!$data) {
//     echo json_encode([
//         "status" => "error",
//         "message" => "Invalid JSON data"
//     ]);
//     exit;
// }

/* Get & sanitize input */
$email    = trim($data['email'] ?? '');
$password = $data['password'] ?? '';

/* Empty check */
if ($email === '' || $password === '') {
    echo json_encode([
        "status" => "error",
        "message" => "Email and password are required"
    ]);
    exit;
}

/* ✅ Email format validation (same as register) */
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid email format"
    ]);
    exit;
}

/* Prepare query */
$stmt = $conn->prepare(
    "SELECT user_id, user_password FROM users WHERE user_email = ? LIMIT 1"
);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

/* Check user */
if ($result && $result->num_rows === 1) {
    $row = $result->fetch_assoc();

    /* Verify password */
    if (password_verify($password, $row['user_password'])) {

        /* Secure session handling */
        session_regenerate_id(true);

        $_SESSION['user_id']    = $row['user_id'];
        $_SESSION['user_email'] = $email;
        $_SESSION['logged_in']  = true;

        echo json_encode([
            "status"  => "success",
            "message" => "Login successful"
        ]);

        exit;
    }
}

/* ❌ Login failed */
echo json_encode([
    "status" => "error",
    "message" => "Invalid email or password"
]);

$stmt->close();
$conn->close();
?>
