<?php include("connection.php");?>
<?php
        if(isset($_POST['submit'])){
            $name = $_POST['fullname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];
            $phone = $_POST['phone'];
            $checkin = $_POST['checkin'];
            $checkout = $_POST['checkout'];
            $guests = $_POST['guests'];
            $roomtype = $_POST['roomtype'];
            $request = $_POST['requests'];

            $hash = password_hash($password, PASSWORD_DEFAULT);

            $fde = "SELECT * FROM `users` WHERE `user_email` = '$email' AND `user_phone` = '$phone'";
            $result = mysqli_query($conn,$fde);
            $isin = false;
            if(mysqli_num_rows($result)>0){
                $isin = true;
            }
            if ($isin) {
                echo "<script>
                        alert('User already exists!');
                        window.location.href = 'login_page.php?email=$email';
                    </script>";
                    exit();
            }else{
                $q = "INSERT INTO `users`(`user_name`, `user_email`, `user_password`, `user_phone`, `check_in`, `check_out`, `user_guests`, `user_type`, `user_request`) VALUES ('$name','$email','$hash','$phone','$checkin','$checkout','$guests','$roomtype','$request')";
                $result = mysqli_query($conn,$q);
                    if($result){
                        session_start();
                        $_SESSION['email'] = "$email";
                        header("Location: login_page.php");
                        exit();
                    }
            }             
        }
    ?>