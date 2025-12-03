<?php include("connection.php");?>
<?php 
    session_start();
    if(isset($_SESSION['email'])){
        $email = $_SESSION['email'];
        $query = "SELECT * FROM `users` WHERE `user_email` = '$email'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About page</title>
    <style>
        body{
            background-color: #d4edf0ff;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .card{
            width: 70%;
            background-color: #d4edf0ff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin: 100px auto;
            padding: 20px;
        }
        h2{
            text-align: center;
            padding-top: 20px;
        }
        table{
            width: 90%;
            margin: 0 auto;
        }
        tr{
            width: 100%;
            height: 50px;
            text-align: center;
            padding: 20px;
            margin: 30px;
            background-color: #fff;
        }
        input{
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 80%;
        }
        input[type="submit"]{
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover{
            background-color: #45a049;
        }
        
        select {
        padding: 12px 15px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 14px;
        background: #f9f9f9;
        transition: all 0.3s ease;
        }   
    </style>
</head>
<body>
  <div class="card">
    <h2>Edit Profile</h2>
   <table>
    <tr>
        <td>Name</td>
        <td><?php echo $row['user_name']; ?></td>
        <td>
            <form action="./update.php" method="post" id="edit">
                <input type="text " placeholder=" New Name" name="name" required>
                <td><input type="submit" name="submit"></td>
            </form>
        </td>
    </tr>
    <tr>
        <td>Email</td>
        <td><?php echo $row['user_email']; ?></td>
        <td>
            <form action="./update.php" method="post" id="edit">
                <input type="email " placeholder="New Email" name="email" required>
                <td><input type="submit" name="submit"></td>
            </form>
        </td>
    </tr>
    <tr>
        <td>Mobile</td>
        <td><?php echo $row['user_phone']; ?></td>
        <td>
            <form action="./update.php" method="post" id="edit">
                <input type="number " placeholder="New number" name="phone" required>
                <td><input type="submit" name="submit"></td>
            </form>
        </td>
    </tr>
    <tr>
        <td>Password</td>
        <td><?php echo "******"; ?></td>
        <td>
            <form action="./update.php" method='post' id="edit">
                <input type="text " placeholder="new password" name="password" required>
                <td><input type="submit" name="submit"></td>
            </form>
        </td>
    </tr>
    <tr>
        <td>checkIn</td>
        <td id="checkindate"><?php echo $row['check_in']; ?></td>
        <td>
            <form action="./update.php" method='post' id="dateForm">
                <input type="date" name="chackin_date" id="checkin" required>
                <td><input type="submit" name="submit"></td>
            </form>
        </td>
    </tr>
    <tr>
        <td>checkout</td>
        <td><?php echo $row['check_out']; ?></td>
        <td>
            <form action="./update.php" method='post' id="dateFormsss">
                <input type="date" name="check_out" id="checkout" required>
                <td><input type="submit" name="submit"></td>
            </form>
        </td>
    </tr>
    <tr>
        <td>Guests</td>
        <td><?php echo $row['user_guests']; ?></td>
        <td>
            <form action="./update.php" method='post' id="edit">
                <input type="number" placeholder="number of guests" min="1" max="5"  name="guests" required>
                <td><input type="submit" name="submit"></td>
            </form>
        </td>
    </tr>
    <tr>
        <td>Room Type</td>
        <td><?php echo $row['user_type']; ?></td>
        <td>
            <form action="./update.php" method='post' id="edit">
            <label>Room Type</label>
            <select id="roomtype" name="roomtype">
              <option value="">--Select--</option>
              <option value="single">Single</option>
              <option value="double">Double</option>
              <option value="suite">Suite</option>
            </select>
                <td><input type="submit" name="submit"></td>
            </form>
        </td>
    </tr>
   </table>
  </div>
  <script>
    document.getElementById("dateForm").addEventListener("submit", function(e) {
        let checkIn = document.getElementById("checkin").value;
        let today = new Date().toISOString().slice(0, 10);
        if (checkIn < today) {
            alert("Check-in date cannot be earlier than today!");
            e.preventDefault();
        }
    });

    let dates = document.getElementById("checkindate").innerHTML;

    document.getElementById("dateFormsss").addEventListener("submit", function(e) {
        let checkout = document.getElementById("checkout").value;
        if (checkout < dates) {
            alert("Check-out date cannot be earlier than check In!");
            e.preventDefault();
        }
    });
</script>

</body>
</html>