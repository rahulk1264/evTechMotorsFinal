<?php
session_start();  // Start session to manage cart
include '../db_connection.php';

// Handle the form submission to add selected AC systems to the cart
if (isset($_POST['add_to_cart'])) {
    if (!isset($_SESSION['cart']['car_ac_systems'])) {
        $_SESSION['cart']['car_ac_systems'] = [];  // Initialize AC systems array
    }

    foreach ($_POST['ac_system_ids'] as $ac_system_id) {
        // Avoid duplicates in the cart
        if (!in_array($ac_system_id, $_SESSION['cart']['car_ac_systems'])) {
            $_SESSION['cart']['car_ac_systems'][] = $ac_system_id;  // Add to AC systems
        }
    }

    header('Location: ../user_dashboard.php');
    exit();

}

// Fetch all AC systems
$sql = "SELECT * FROM car_ac_systems";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>EV Company - Car AC Systems</title>
  <link rel="stylesheet" href="./common_styles.css">
</head>
<body>

<h2>Select Car AC Systems to Add to Your Cart</h2>

<form action="car_ac_systems.php" method="POST">
    <table>
      <thead>
        <tr>
            <th>Select</th>
            <th>AC ID</th>
            <th>Car Model</th>
            <th>AC Type</th>
            <th>Refrigerant Type</th>
            <th>AC Capacity (W)</th>
            <th>Cooling Capacity (kW)</th>
            <th>Heating Capacity (kW)</th>
            <th>Compressor Brand</th>
            <th>Compressor Type</th>
            <th>Air Filter Type</th>
            <th>Cabin Air Filter</th>
            <th>Climate Control</th>
            <th>Ventilation System</th>
            <th>Multi-Zone Climate</th>
            <th>Air Quality Control</th>
            <th>AC Efficiency Rating</th>
            <th>Cost Estimate (USD)</th>
            <th>Warranty (Years)</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><input type='checkbox' name='ac_system_ids[]' value='" . $row['ac_id'] . "'></td>";
                echo "<td>" . htmlspecialchars($row['ac_id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['car_model']) . "</td>";
                echo "<td>" . htmlspecialchars($row['ac_type']) . "</td>";
                echo "<td>" . htmlspecialchars($row['refrigerant_type']) . "</td>";
                echo "<td>" . htmlspecialchars($row['ac_capacity']) . "</td>";
                echo "<td>" . htmlspecialchars($row['cooling_capacity']) . "</td>";
                echo "<td>" . htmlspecialchars($row['heating_capacity']) . "</td>";
                echo "<td>" . htmlspecialchars($row['compressor_brand']) . "</td>";
                echo "<td>" . htmlspecialchars($row['compressor_type']) . "</td>";
                echo "<td>" . htmlspecialchars($row['air_filter_type']) . "</td>";
                echo "<td>" . ($row['cabin_air_filter'] ? 'Yes' : 'No') . "</td>";
                echo "<td>" . ($row['climate_control'] ? 'Yes' : 'No') . "</td>";
                echo "<td>" . htmlspecialchars($row['ventilation_system']) . "</td>";
                echo "<td>" . ($row['multi_zone_climate'] ? 'Yes' : 'No') . "</td>";
                echo "<td>" . ($row['air_quality_control'] ? 'Yes' : 'No') . "</td>";
                echo "<td>" . htmlspecialchars($row['ac_efficiency_rating']) . "</td>";
                echo "<td>" . htmlspecialchars($row['cost_estimate_usd']) . "</td>";
                echo "<td>" . htmlspecialchars($row['warranty_years']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='19'>No car AC systems available.</td></tr>";
        }
        ?>
      </tbody>
    </table>

    <button type="submit" name="add_to_cart" class="cta-button">Add to Cart & Go Back to Dashboard</button>
</form>

</body>
</html>
