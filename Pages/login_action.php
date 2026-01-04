<?php
session_start();
header("Content-Type: application/json; charset=UTF-8");
include("../connection.php");

$data = json_decode(file_get_contents("php://input"), true);

$email = trim($data['email'] ?? '');
$password = $data['password'] ?? '';

if (empty($email) || empty($password)) {
    echo json_encode([
        "status" => "error",
        "message" => "Email and password are required"
    ]);
    exit;
}

$stmt = $conn->prepare(
    "SELECT user_id, user_password FROM users WHERE user_email = ?"
);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();

    if (password_verify($password, $row['user_password'])) {

        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['user_email'] = $email;

        echo json_encode([
            "status" => "success"
        ]);
        exit;
    }
}

// ❌ Login failed
echo json_encode([
    "status" => "error",
    "message" => "Invalid email or password"
]);

$stmt->close();
$conn->close();
?>