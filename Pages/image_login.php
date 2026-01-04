<?php
session_start();
header("Content-Type: application/json");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

include("../connection.php");

/* Read JSON */
$data = json_decode(file_get_contents("php://input"), true);
$user_email = trim($data['user_email'] ?? '');

/* Validate */
if ($user_email === '') {
    echo json_encode(["status" => "error", "message" => "Invalid user"]);
    exit;
}

/* If already logged in */
if (isset($_SESSION['user_email'])) {

    if ($_SESSION['user_email'] === $user_email) {
        echo json_encode(["status" => "success"]);
        exit;
    }

    echo json_encode([
        "status" => "error",
        "message" => "Please logout first"
    ]);
    exit;
}

/* Check user */
$stmt = $conn->prepare(
    "SELECT user_id, user_email FROM users WHERE user_email = ? LIMIT 1"
);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {

    $user = $result->fetch_assoc();
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['user_email'] = $user['user_email'];

    echo json_encode(["status" => "success"]);

} else {
    echo json_encode(["status" => "error", "message" => "User not found"]);
}

$stmt->close();
$conn->close();
