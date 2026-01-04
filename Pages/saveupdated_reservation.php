<?php
session_start();
header('Content-Type: application/json');
include("../connection.php");

$data = json_decode(file_get_contents("php://input"), true);

$c_in_date   = $data['c_in_date'] ?? '';
$c_out_date  = $data['c_out_date'] ?? '';
$guest       = $data['guest'] ?? '';
$room_type   = $data['room_type'] ?? '';
$special_req = $data['special_req'] ?? '';
$r_id        = $data['r_id'] ?? '';
$user_id     = $_SESSION['user_id'] ?? '';

/* =====================
   VALIDATION
===================== */
if (!$user_id) {
    echo json_encode(['status'=>'error','message'=>'User not logged in']);
    exit;
}

if (empty($c_in_date)) {
    echo json_encode(['status'=>'error','message'=>'Check-in date is required']);
    exit;
}

if (empty($c_out_date)) {
    echo json_encode(['status'=>'error','message'=>'Check-out date is required']);
    exit;
}

if (empty($guest) || empty($room_type)) {
    echo json_encode(['status'=>'error','message'=>'Missing required fields']);
    exit;
}

/* =====================
   CHECK DATE OVERLAP
   (exclude current reservation)
===================== */
$checkSql = "
    SELECT r_id FROM reservations
    WHERE user_id = ?
      AND r_id != ?
      AND c_in_date <= ?
      AND c_out_date >= ?
";

$checkStmt = $conn->prepare($checkSql);
$checkStmt->bind_param("iiss", $user_id, $r_id, $c_out_date, $c_in_date);
$checkStmt->execute();
$checkStmt->store_result();

if ($checkStmt->num_rows > 0) {
    echo json_encode([
        'status'=>'error',
        'message'=>'You already have a reservation overlapping these dates'
    ]);
    exit;
}
$checkStmt->close();

/* =====================
   UPDATE RESERVATION
===================== */
$updateSql = "
    UPDATE reservations
    SET c_in_date=?, c_out_date=?, guest=?, room_type=?, special_req=?
    WHERE r_id=? AND user_id=?
";

$stmt = $conn->prepare($updateSql);
$stmt->bind_param(
    "ssissii",
    $c_in_date,
    $c_out_date,
    $guest,
    $room_type,
    $special_req,
    $r_id,
    $user_id
);

if ($stmt->execute()) {
    echo json_encode(['status'=>'success','message'=>'Reservation updated successfully']);
} else {
    echo json_encode(['status'=>'error','message'=>'Failed to update reservation']);
}

$stmt->close();
$conn->close();
exit;
?>
