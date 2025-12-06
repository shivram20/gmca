<?php include("../connection.php");
session_start();
$email = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Reservation form</title>
    <link rel="stylesheet" href="../css/reservationform.css">
</head>
<body>
     <div class="container">
      <form action="" method="post" class="box" id="reservationForm">
      <div class="right">
          <h3>Reservation Details</h3>
          <div>
            <label>Check-in Date</label>
            <input type="date" id="checkin" name="checkin" />
          </div>
          <div>
            <label>Check-out Date</label>
            <input type="date" id="checkout" name="checkout" />
          </div>
          <div>
            <label>Number Of Guests</label>
            <input type="number" id="guests" name="guests" min="1" max="5" />
          </div>
          <div>
            <label>Room Type</label>
            <select id="roomtype" name="roomtype">
              <option value="">--Select--</option>
              <option value="single">Single</option>
              <option value="double">Double</option>
              <option value="suite">Suite</option>
            </select>
          </div>
          <div>
            <label>Special Requests</label>
            <textarea
              id="requests"
              name="requests"
              rows="3"
              placeholder="Any special requirements?"
            ></textarea>
          </div>
        </div>

        <div class="buttons">
          <button type="submit" name="submit">Submit</button>
          <button type="reset" name="reset">Reset</button>
        </div>
      </form>
    </div>

    <!--  reservation form data -->

    <?php 
    $query = "SELECT * FROM `reservations` WHERE `email` = '$email'";
    $result = mysqli_query($conn, $query);

    ?>

    <div class="containerdata">
      <h2>Reservation Details</h2>
      <table>
        <tr>
          <th>Check-in Date</th>
          <th>Check-out Date</th>
          <th>Number of Guests</th>
          <th>Room Type</th>
          <th>Special Requests</th>
          <th>Operations</th>
        </tr>
         <?php 
      while ($row = mysqli_fetch_assoc($result)) { 
    ?>
        <tr>
          <td><?php echo $row['c_in_date']; ?></td>
          <td><?php echo $row['c_out_date']; ?></td>
          <td><?php echo $row['guest']; ?></td>
          <td><?php echo $row['room_type']; ?></td>
          <td><?php echo $row['special_req']; ?></td>
          <td>
            <a href="../Files/editreservation.php?id=<?php echo $row['r_id']; ?>">Edit</a> |
            <a href="../Files/deletereservation.php?id=<?php echo $row['r_id']; ?>">Delete</a>
          </td>
      </tr>
        <?php } ?>
      </table>
    </div>

    <script src="../script/reservationscript.js"></script>
</body>
</html>

<?php 
  if(isset($_POST['submit'])){
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $guests = $_POST['guests'];
    $roomtype = $_POST['roomtype'];
    $requests = $_POST['requests'];

    $query = "SELECT * FROM `reservations` WHERE `c_in_date` = '$checkin' AND `c_out_date` = '$checkout' AND `email` = '$email'";
    $result = mysqli_query($conn, $query);
    $c = mysqli_num_rows($result);

    if($c){
      echo "
        <script>
        alert('This date is already reserved for you');
        </script>
        ";
      }else{
        $query = "INSERT INTO `reservations`(`c_in_date`, `c_out_date`, `guest`, `room_type`, `special_req`, `email`)
        VALUES ('$checkin','$checkout','$guests','$roomtype','$requests','$email')";
        $result = mysqli_query($conn, $query);

        if($result){
          echo "
          <script>
          alert('Reservation successful');
          </script>
          ";
          header("Location: reservation.php");
        }else{
          echo "
          <script>
          alert('Reservation failed');
          </script>
          ";
          header("Location: reservation.php");
        }
      }


    
  }
?>