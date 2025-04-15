<?php
include '../db_connection.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['userid'])) {
    header('Location: ../user_dashboard.php');
    exit();
}

$user_id = $_SESSION['userid'];

// Query to fetch orders for the logged-in user, including all columns from the orders table
$query = "SELECT * FROM orders WHERE user_id = $user_id ORDER BY order_date DESC";
$result = $conn->query($query);

if ($result && $result->num_rows > 0) {
    // Display orders in a table format
    echo "<h2>Your Orders</h2>";
    echo "<table border='1' cellpadding='10' cellspacing='0' style='border-collapse: collapse; width: 100%;'>";
    echo "<thead>";
    echo "<tr><th>Order ID</th><th>Order Date</th><th>Battery ID</th><th>AC System ID</th><th>Chassis ID</th><th>Display ID</th><th>Interior ID</th><th>Paint ID</th><th>Music System ID</th><th>Wheel ID</th></tr>";
    echo "</thead>";
    echo "<tbody>";

    // Fetch and display each order
    while ($order = $result->fetch_assoc()) {
        $order_id = $order['order_id'];
        $order_date = $order['order_date'];
        $battery_id = $order['battery_id'];
        $ac_system_id = $order['ac_system_id'];
        $chassis_id = $order['chassis_id'];
        $display_id = $order['display_id'];
        $interior_id = $order['interior_id'];
        $paint_id = $order['paint_id'];
        $music_system_id = $order['music_system_id'];
        $wheel_id = $order['wheel_id'];

        // Output order details
        echo "<tr>";
        echo "<td>$order_id</td>";
        echo "<td>$order_date</td>";
        echo "<td>$battery_id</td>";
        echo "<td>$ac_system_id</td>";
        echo "<td>$chassis_id</td>";
        echo "<td>$display_id</td>";
        echo "<td>$interior_id</td>";
        echo "<td>$paint_id</td>";
        echo "<td>$music_system_id</td>";
        echo "<td>$wheel_id</td>";
        
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
} else {
    // If the user has no orders
    echo "<p>No orders found.</p>";
}

$conn->close();
?>

<!-- Optionally, you can include a link back to the dashboard -->
<p><a href="../user_dashboard.php">Back to Dashboard</a></p>
