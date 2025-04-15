<?php
session_start();  // Start session to manage cart
include '../db_connection.php';

// Handle the form submission to add selected wheels to the cart
if (isset($_POST['add_to_cart'])) {
    if (!isset($_SESSION['cart']['wheels'])) {
        $_SESSION['cart']['wheels'] = [];  // Initialize wheels array
    }

    foreach ($_POST['wheel_ids'] as $wheel_id) {
        // Avoid duplicates in the cart
        if (!in_array($wheel_id, $_SESSION['cart']['wheels'])) {
            $_SESSION['cart']['wheels'][] = $wheel_id;  // Add to wheels cart
        }
    }

    header('Location: ../user_dashboard.php');
    exit();
}

// Fetch all wheels
$sql = "SELECT * FROM wheels";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EV Company - Wheels Overview</title>
    <link rel="stylesheet" href="./common_styles.css">
</head>
<body>

<form action="wheels.php" method="POST">
    <table>
        <thead>
            <tr>
                <th>Select</th>
                <th>Wheel ID</th>
                <th>Car Model</th>
                <th>Brand</th>
                <th>Type</th>
                <th>Diameter</th>
                <th>Width</th>
                <th>Rim Material</th>
                <th>Tire Type</th>
                <th>Tire Brand</th>
                <th>Tire Size</th>
                <th>Bolt Pattern</th>
                <th>Offset</th>
                <th>Load Index</th>
                <th>Speed Rating</th>
                <th>Max Air Pressure</th>
                <th>Tire Pressure Monitoring</th>
                <th>Hub Diameter</th>
                <th>Weight</th>
                <th>Cost Estimate (USD)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><input type='checkbox' name='wheel_ids[]' value='" . $row['wheel_id'] . "'></td>";
                    echo "<td>" . htmlspecialchars($row['wheel_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['car_model']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['brand']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['type']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['diameter']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['width']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['rim_material']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['tire_type']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['tire_brand']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['tire_size']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['bolt_pattern']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['offset']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['load_index']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['speed_rating']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['air_pressure_max']) . "</td>";
                    echo "<td>" . ($row['tire_pressure_monitoring_system'] ? "Yes" : "No") . "</td>";
                    echo "<td>" . htmlspecialchars($row['hub_diameter']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['weight']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['cost_estimate_usd']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='20'>No wheels available.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <button type="submit" name="add_to_cart" class="cta-button">Add to Cart</button>
</form>

</body>
</html>
