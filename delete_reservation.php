<?php
    if(isset($_GET['id'])){
        include("./connection.php");
        $id = $_GET['id'];
        $query = "DELETE FROM `reservations` WHERE `r_id` = '$id'";
        $result = mysqli_query($conn, $query);
        if($result){
            echo "
            <script>
                alert('Reservation deleted successfully');
                window.location.href = 'index.php';
            </script>
            ";
            exit();
        }
    }
?>