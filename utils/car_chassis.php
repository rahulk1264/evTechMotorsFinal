<?php
session_start();  // Start session to manage cart
include '../db_connection.php';

// Handle the form submission to add selected chassis to the cart
if (isset($_POST['add_to_cart'])) {
    if (!isset($_SESSION['cart']['car_chassis'])) {
        $_SESSION['cart']['car_chassis'] = [];  // Initialize car_chassis array
    }

    // Add selected car chassis to the cart
    foreach ($_POST['chassis_ids'] as $chassis_id) {
        // Avoid duplicates in the cart
        if (!in_array($chassis_id, $_SESSION['cart']['car_chassis'])) {
            $_SESSION['cart']['car_chassis'][] = $chassis_id;  // Add to car_chassis
        }
    }

    header('Location: ../user_dashboard.php');
    exit(); // Make sure no further code is executed after the redirect
}

// Fetch all car chassis
$sql = "SELECT * FROM car_chassis";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>EV Company - Car Chassis</title>
  <link rel="stylesheet" href="./common_styles.css">
</head>
<body>

<h2>Select Car Chassis to Add to Your Cart</h2>

<form action="car_chassis.php" method="POST">
    <table>
      <thead>
        <tr>
            <th>Select</th>
            <th>Chassis ID</th>
            <th>Car Model</th>
            <th>Chassis Type</th>
            <th>Material Used</th>
            <th>Frame Structure</th>
            <th>Weight (kg)</th>
            <th>Length (mm)</th>
            <th>Width (mm)</th>
            <th>Height (mm)</th>
            <th>Wheelbase (mm)</th>
            <th>Front Suspension Type</th>
            <th>Rear Suspension Type</th>
            <th>Shock Absorber Type</th>
            <th>Ground Clearance (mm)</th>
            <th>Number of Doors</th>
            <th>Number of Seats</th>
            <th>Max Payload (kg)</th>
            <th>Max Towing Capacity (kg)</th>
            <th>Chassis Color</th>
            <th>Cost Estimate (USD)</th>
            <th>Warranty (Years)</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><input type='checkbox' name='chassis_ids[]' value='" . $row['chassis_id'] . "'></td>";
                echo "<td>" . htmlspecialchars($row['chassis_id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['car_model']) . "</td>";
                echo "<td>" . htmlspecialchars($row['chassis_type']) . "</td>";
                echo "<td>" . htmlspecialchars($row['material_used']) . "</td>";
                echo "<td>" . htmlspecialchars($row['frame_structure']) . "</td>";
                echo "<td>" . htmlspecialchars($row['weight_kg']) . "</td>";
                echo "<td>" . htmlspecialchars($row['length_mm']) . "</td>";
                echo "<td>" . htmlspecialchars($row['width_mm']) . "</td>";
                echo "<td>" . htmlspecialchars($row['height_mm']) . "</td>";
                echo "<td>" . htmlspecialchars($row['wheelbase_mm']) . "</td>";
                echo "<td>" . htmlspecialchars($row['front_suspension_type']) . "</td>";
                echo "<td>" . htmlspecialchars($row['rear_suspension_type']) . "</td>";
                echo "<td>" . htmlspecialchars($row['shock_absorber_type']) . "</td>";
                echo "<td>" . htmlspecialchars($row['ground_clearance_mm']) . "</td>";
                echo "<td>" . htmlspecialchars($row['number_of_doors']) . "</td>";
                echo "<td>" . htmlspecialchars($row['number_of_seats']) . "</td>";
                echo "<td>" . htmlspecialchars($row['maximum_payload_kg']) . "</td>";
                echo "<td>" . htmlspecialchars($row['maximum_towing_capacity_kg']) . "</td>";
                echo "<td>" . htmlspecialchars($row['chassis_color']) . "</td>";
                echo "<td>" . htmlspecialchars($row['cost_estimate_usd']) . "</td>";
                echo "<td>" . htmlspecialchars($row['warranty_years']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='21'>No car chassis available.</td></tr>";
        }
        ?>
      </tbody>
    </table>

    <button type="submit" name="add_to_cart" class="cta-button">Add to Cart</button>
</form>

</body>
</html>
