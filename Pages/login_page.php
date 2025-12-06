<?php include("../connection.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style_login.css" />
</head>
<body>
    <form action="" method="post">
        <h3>Login Form</h3>
        <input type="email" id="email" name="email" placeholder="Email" required><br>
        <input type="password" id="password" name="password" placeholder="Password" required><br>
        <p>Don't have an account ? <a href="./Registration.php">Register</a></p>
        <input type="submit" name="submit" onsubmit="submitbtn()" value="Login">
    </form>
</body>
</html>

<?php
     session_start(); 
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        if(empty($email) || empty($password)){
            echo "alert('Please fill all the fields')";
            header("Location: login_page.php?error=1");
            exit();
        }

        $q = "SELECT * FROM `users` WHERE `user_email` = '$email'";
        $result = mysqli_query($conn, $q);
        $row = mysqli_fetch_assoc($result);
        
    
        if(mysqli_num_rows($result) > 0){
            if(password_verify($password, $row['user_password'])){
                $_SESSION['email'] = $email;
                $_SESSION['enabled'] = true;
                header("Location: ../index.php");
                exit();
            }
        } else {
            $_SESSION['enabled'] = false;
            echo"<script>alert('Invalid Email or Password!');</script>";
            exit();
        }
    }
?>

