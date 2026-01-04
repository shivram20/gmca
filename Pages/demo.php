<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: center;
    }

    th {
        background: #f89f39ff;
        color: #fff;
    }

    .pagination {
        text-align: center;
        margin-top: 15px;
    }

    .pagination a {
        padding: 6px 12px;
        margin: 0 3px;
        border: 1px solid #f89f39ff;
        color: #f89f39ff;
        text-decoration: none;
    }

    .pagination a.active,
    .pagination a:hover {
        background: #f89f39ff;
        color: #fff;
    }
</style>

<?php
include("../connection.php");
session_start();

$user_id = $_SESSION['user_id'] ?? 0;
$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Total rows for pagination
$total_result = $conn->query("SELECT COUNT(*) as total FROM reservations WHERE user_id='$user_id'");
$total_row = $total_result->fetch_assoc();
$total_pages = ceil($total_row['total'] / $limit);

// Fetch current page data
$sql = "SELECT * FROM reservations WHERE user_id='$user_id' ORDER BY r_id DESC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);
?>

<table>
    <tr>
        <th>Check-in</th>
        <th>Check-out</th>
        <th>Guests</th>
        <th>Room</th>
        <th>Actions</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
            <td>{$row['c_in_date']}</td>
            <td>{$row['c_out_date']}</td>
            <td>{$row['guest']}</td>
            <td>{$row['room_type']}</td>
            <td>
                <a href='#!/editreservation/{$row['r_id']}'>Edit</a> |
                <a href='./delete_reservation.php?id={$row['r_id']}' onclick=\"return confirm('Cancel?')\">Cancel</a>
            </td>
        </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No data found</td></tr>";
    }
    ?>
</table>

<div class="pagination">
    <?php
    $total_result = $conn->query("SELECT COUNT(*) as total FROM reservations WHERE user_id='$user_id'");
    $total_row = $total_result->fetch_assoc();
    $total_pages = ceil($total_row['total'] / $limit);

    $baseUrl = "#!/demo"; // AngularJS hash route

    if ($page > 1) {
        echo '<a href="' . $baseUrl . '?page=' . ($page - 1) . '" onclick="window.location.href=this.href; return false;">Prev</a>';
    }

    for ($i = 1; $i <= $total_pages; $i++) {
        $active = ($i == $page) ? 'active' : '';
        echo '<a href="' . $baseUrl . '?page=' . $i . '" class="' . $active . '" onclick="window.location.href=this.href; return false;">' . $i . '</a>';
    }

    if ($page < $total_pages) {
        echo '<a href="' . $baseUrl . '?page=' . ($page + 1) . '" onclick="window.location.href=this.href; return false;">Next</a>';
    }
    ?>
</div>