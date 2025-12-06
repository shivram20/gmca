<?php include("../connection.php");?>
<?php
        if(isset($_POST['submit'])){
            $name = $_POST['fullname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];
            $phone = $_POST['phone'];

            $hash = password_hash($password, PASSWORD_DEFAULT);

            $fde = "SELECT user_email FROM users WHERE user_email = '$email'";
            $ce = mysqli_query($conn, $fde);
            $rrow = mysqli_fetch_assoc($ce);

            
            $fdp = "SELECT user_phone FROM users WHERE user_phone = '$phone'";
            $pe = mysqli_query($conn, $fdp);
            $prow = mysqli_fetch_assoc($pe);

            if ($rrow) {
                echo "<script>
                        alert('Email already used.');
                        window.location.href='../Pages/Registration.php?email=$email';
                    </script>";
                exit();
            } elseif($prow){
                echo "<script>
                        alert('Phone number already used.');
                        window.location.href='../Pages/Registration.php?phone=$phone';
                    </script>";
                exit();
            }else{
                 $q = "INSERT INTO users (user_name, user_email, user_password, user_phone)
                VALUES ('$name', '$email', '$hash', '$phone')";
                $result = mysqli_query($conn, $q);

                if ($result) {
                    session_start();
                    $_SESSION['email'] = $email;
                    header("Location: ../Pages/login_page.php");
                    exit();
                } else {
                    echo "<script>alert('Registration failed!');</script>";
                }
            }        
        }
    ?>