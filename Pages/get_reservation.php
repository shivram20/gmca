<?php
session_start();
header('Content-Type: application/json');
include("../connection.php");

$user_id = $_SESSION['user_id'] ?? 0;
$r_id = $_GET['id'] ?? 0;

$stmt = $conn->prepare("SELECT r_id, c_in_date, c_out_date, guest, room_type, special_req FROM reservations WHERE r_id=? AND user_id=?");
$stmt->bind_param("ii", $r_id, $user_id);
$stmt->execute();
$reservation = $stmt->get_result()->fetch_assoc();

echo json_encode($reservation);

$stmt->close();
$conn->close();
?>