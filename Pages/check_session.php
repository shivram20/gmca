<?php
// session_start();
// header("Content-Type: application/json");
// header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

// echo json_encode([
//     "loggedIn"   => isset($_SESSION['user_id']),
//     "user_email" => $_SESSION['user_email'] ?? null
// ]);
// exit;

session_start();
header("Content-Type: application/json");

echo json_encode([
    "loggedIn" => isset($_SESSION['user_id']),
    "user_email" => $_SESSION['user_email'] ?? null
]);
exit;

?>