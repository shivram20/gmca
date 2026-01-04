<?php
// session_start();
// header("Content-Type: application/json");
// header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

// session_unset();
// session_destroy();

// echo json_encode([
//     "status" => "success"
// ]);
// exit;
session_start();
session_unset();
session_destroy();
echo json_encode(["status" => "success"]);

?>