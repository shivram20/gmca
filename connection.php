<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "gmca_db";

    $conn = new mysqli($server, $username, $password, $database);
    if(!$conn){
        die("Error: " . $conn->connect_error);
    }
    // echo "Connected Successfully";
?>
