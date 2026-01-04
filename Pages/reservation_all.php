<?php include("../connection.php");
    session_start();
    $user_id = $_SESSION['user_id'];
?> 

<style>
         .containerdata {
        max-width: 1000px;
        margin: 40px auto;
        padding: 20px;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        overflow-x: auto; /* allows horizontal scroll on small screens */
    }

    .containerdata h2 {
        text-align: center;
        color: #333;
        margin-bottom: 20px;
        font-size: 28px;
        border-bottom: 2px solid #f89f39ff;
        display: inline-block;
        padding-bottom: 5px;
    }

    /* ===== Table Styling ===== */
    table {
        width: 100%;
        border-collapse: collapse;
        min-width: 600px; /* ensures table looks good on desktop */
    }

    th, td {
        padding: 12px 15px;
        text-align: center;
        border-bottom: 1px solid #ddd;
        font-size: 16px;
    }

    th {
        background-color: #f89f39ff;
        color: white;
        font-weight: 600;
        text-transform: uppercase;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    /* ===== Action Links ===== */
    td a {
        text-decoration: none;
        color: #f89f39ff;
        font-weight: 500;
        margin: 0 5px;
        transition: 0.3s;
    }


    /* ===== Responsive ===== */
    @media (max-width: 768px) {
        th, td {
            padding: 10px 8px;
            font-size: 14px;
        }

        .containerdata h2 {
            font-size: 24px;
        }
    }

    @media (max-width: 500px) {
        table {
            font-size: 12px;
        }
        th, td {
            padding: 8px 5px;
        }
    }
</style>

<div class="containerdata">
          <h2>Reservation History</h2>
          <table>
            <tr>
              <th>Check-in Date</th>
              <th>Check-out Date</th>
              <th>Guests</th>
              <th>Room Type</th>
              <th>Special Requests</th>
              <th>Actions</th>
            </tr>
            <?php
            $sql = "SELECT * FROM reservations WHERE user_id = '$user_id'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["c_in_date"] . "</td>";
                echo "<td>" . $row["c_out_date"] . "</td>";
                echo "<td>" . $row["guest"] . "</td>";
                echo "<td>" . $row["room_type"] . "</td>";
                echo "<td>" . $row["special_req"] . "</td>";
                echo "<td> <a href='#!/editreservation/" . $row["r_id"] . "'>Edit</a> |   <a href='./delete_reservation.php?id=" . $row["r_id"] . "' onclick=\"return confirm('Are you sure you want to cancel this reservation?')\">Cancel</a></td>";
                echo "</tr>";
              }
            } else {
              echo "<tr><td colspan='5'>No reservation history found.</td></tr>";   
            }
            ?>
          </table>
        </div>
    </div>
    
