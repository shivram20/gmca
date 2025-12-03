<?php include("connection.php");?>
<?php
    session_start();
    $email = $_SESSION['email'];
    if(isset($_POST['submit'])){
        // Name Update
        if($name = $_POST['name']){
             $query = "UPDATE `users` SET `user_name` = '$name' WHERE `user_email` = '$email'";
            $result = mysqli_query($conn, $query);
            if($result){
                header("location: about.php");
            }
        }
        // Email update
        if($e = $_POST['email']){
             $query = "UPDATE `users` SET `user_email` = '$e' WHERE `user_email` = '$email'";
            $result = mysqli_query($conn, $query);
            if($result){
                $_SESSION['email'] = $e;
                header("location: index.php");
            }
        }
        // Mobile update
         if($p = $_POST['phone']){
             $query = "UPDATE `users` SET `user_phone` = '$p' WHERE `user_email` = '$email'";
            $result = mysqli_query($conn, $query);
            if($result){
                header("location: About.php");
            }
        }
        // password Update
         if($pc = $_POST['password']){
            $hash = password_hash($pc, PASSWORD_DEFAULT);
            $query = "UPDATE `users` SET `user_password` = '$hash' WHERE `user_email` = '$email'";
            $result = mysqli_query($conn, $query);
            if($result){
                header("location: About.php");
            }
        }
        // check in date update
         if($cd = $_POST['chackin_date']){
                $query = "UPDATE `users` SET `check_in` = '$cd' WHERE `user_email` = '$email'";
                $result = mysqli_query($conn, $query);
                if($result){
                    header("location: About.php");
                } 
            }
        }
        // check out date update
         if($cod = $_POST['check_out']){
            $query = "UPDATE `users` SET `check_out` = '$cod' WHERE `user_email` = '$email'";
            $result = mysqli_query($conn, $query);
            if($result){
                header("location: About.php");
            }
        }
        //guests uppdate
         if($g = $_POST['guests']){
            $query = "UPDATE `users` SET `user_guests` = '$g' WHERE `user_email` = '$email'";
            $result = mysqli_query($conn, $query);
            if($result){
                header("location: About.php");
            }
        }
        // room type Update
         if($rt = $_POST['roomtype']){
            $query = "UPDATE `users` SET `user_type` = '$rt' WHERE `user_email` = '$email'";
            $result = mysqli_query($conn, $query);
            if($result){
                header("location: About.php");
            }
        }
?>
