<?php 
include("../connection.php");
$id = $_GET['id'];
$query = "SELECT * FROM `reservations` WHERE `r_id` = '$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

$query = "DELETE FROM `reservations` WHERE `r_id` = '$id'";
$result = mysqli_query($conn, $query);
if ($result) {
    echo "
    <script>
        alert('Reservation deleted successfully');
        window.location.href = '../Pages/Reservation.php';
    </script>
    ";
    exit();
}
?>