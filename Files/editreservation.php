<?php 
include("../connection.php");
$id = $_GET['id'];
$query = "SELECT * FROM `reservations` WHERE `r_id` = '$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

// update the reservation details
if(isset($_POST['submit'])){
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $guests = $_POST['guests'];
    $roomtype = $_POST['roomtype'];
    $requests = $_POST['requests'];

    $query = "UPDATE `reservations` SET `c_in_date` = '$checkin', `c_out_date` = '$checkout', `guest` = '$guests', `room_type` = '$roomtype', `special_req` = '$requests' WHERE `r_id` = '$id'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "
        <script>
            alert('Reservation updated successfully');
            window.location.href = '../Pages/Reservation.php';
        </script>
        ";
        exit();
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/reservationform.css">
</head>
<body>
    <div class="container">
      <form action="" method="post" class="box" id="reservationForm">
      <div class="right">
          <h3>Reservation Details</h3>
          <div>
            <label>Check-in Date</label>
            <input type="date" id="checkin" value="<?php echo $row['c_in_date']; ?>" name="checkin" />
          </div>
          <div>
            <label>Check-out Date</label>
            <input type="date" id="checkout" value="<?php echo $row['c_out_date']; ?>" name="checkout" />
          </div>
          <div>
            <label>Number Of Guests</label>
            <input type="number" id="guests" value="<?php echo $row['guest']; ?>" name="guests" min="1" max="5" />
          </div>
         <div>
          <label>Room Type</label>
          <select id="roomtype" name="roomtype" required> 
              <option value="">--Select--</option>
              <option value="single" >Single</option>
              <option value="double" >Double</option>
              <option value="suite" >Suite</option>
          </select>
        </div>
          <div>
            <label>Special Requests</label>
            <textarea
              id="requests"
              name="requests"
              value = "<?php echo $row['special_req']; ?>"
              placeholder="Enter any special requests"
              rows="3"
              required
            ></textarea>
          </div>
        </div>

        <div class="buttons">
          <button type="submit" name="submit">Submit</button>
          <button type="reset" name="reset">Reset</button>
        </div>
      </form>
    </div>
    <script src="../script/reservationscript.js"></script>
</body>
</html>