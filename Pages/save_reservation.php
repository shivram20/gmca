<?php
session_start();
header('Content-Type: application/json');
include("../connection.php");

/* =========================
   Check login
========================= */
if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'User not logged in.'
    ]);
    exit;
}

/* =========================
   Read JSON input
========================= */
$data = json_decode(file_get_contents("php://input"), true);

$c_in_date   = $data['checkin']   ?? '';
$c_out_date  = $data['checkout']  ?? '';
$guest       = $data['guests']    ?? '';
$room_type   = $data['roomtype']  ?? '';
$special_req = $data['requests']  ?? '';
$user_id     = $_SESSION['user_id'];

/* =========================
   Basic validation
========================= */
if (
    empty($c_in_date) ||
    empty($c_out_date) ||
    empty($guest) ||
    empty($room_type)
) {
    echo json_encode([
        'status' => 'error',
        'message' => 'All required fields must be filled.'
    ]);
    exit;
}

/* =========================
   Date validation
========================= */
if (strtotime($c_out_date) <= strtotime($c_in_date)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Check-out date must be after check-in date.'
    ]);
    exit;
}

/* =========================
   OVERLAP CHECK (FIXED)
========================= */
$checkStmt = $conn->prepare("
    SELECT COUNT(*) AS total
    FROM reservations
    WHERE user_id = ?
      AND (
          (? BETWEEN c_in_date AND DATE_SUB(c_out_date, INTERVAL 1 DAY))
          OR
          (? BETWEEN DATE_ADD(c_in_date, INTERVAL 1 DAY) AND c_out_date)
          OR
          (c_in_date BETWEEN ? AND ?)
      )
");

$checkStmt->bind_param(
    "issss",
    $user_id,
    $c_in_date,
    $c_out_date,
    $c_in_date,
    $c_out_date
);

$checkStmt->execute();
$result = $checkStmt->get_result()->fetch_assoc();

if ($result['total'] > 0) {
    echo json_encode([
        'status' => 'error',
        'message' => 'You already have a reservation that overlaps with these dates.'
    ]);
    exit;
}

/* =========================
   INSERT RESERVATION
========================= */
$stmt = $conn->prepare("
    INSERT INTO reservations
    (c_in_date, c_out_date, guest, room_type, special_req, user_id)
    VALUES (?, ?, ?, ?, ?, ?)
");

$stmt->bind_param(
    "ssissi",
    $c_in_date,
    $c_out_date,
    $guest,
    $room_type,
    $special_req,
    $user_id
);

if ($stmt->execute()) {
    echo json_encode([
        'status' => 'success',
        'message' => 'Reservation saved successfully.'
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Database error: ' . $stmt->error
    ]);
}

/* =========================
   Close connections
========================= */
$stmt->close();
$checkStmt->close();
$conn->close();
?>
