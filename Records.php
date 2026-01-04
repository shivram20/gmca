<?php
session_start();
header('Content-Type: application/json');
include("../connection.php");
// your database connection


$n = 100;
while ($n) {
    $stmt = $conn->prepare("
  INSERT INTO reservations 
  (c_in_date, c_out_date, guest, room_type, special_req, user_id) 
  VALUES (?, ?, ?, ?, ?, ?)
");
    $stmt->bind_param("ssissi", $c_in_date, $c_out_date, $guest, $room_type, $special_req, $user_id);
}
