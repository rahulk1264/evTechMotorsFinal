<?php
session_start();  // Start session to manage cart
include '../db_connection.php';

// Handle the form submission to add selected car display systems to the cart
if (isset($_POST['add_to_cart'])) {
  if (!isset($_SESSION['cart']['car_display_systems'])) {
      $_SESSION['cart']['car_display_systems'] = [];  // Initialize car display systems array
  }

  foreach ($_POST['display_ids'] as $display_id) {
      // Avoid duplicates in the cart
      if (!in_array($display_id, $_SESSION['cart']['car_display_systems'])) {
          $_SESSION['cart']['car_display_systems'][] = $display_id;  // Add to car display systems
      }
  }

  header('Location: ../user_dashboard.php');
  exit();
}

// Fetch all car display systems
$sql = "SELECT * FROM car_display_systems";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>EV Company - Car Display Systems Overview</title>
  <link rel="stylesheet" href="./common_styles.css">
</head>
<body>

<form action="car_display_systems.php" method="POST">
    <table>
      <thead>
        <tr>
            <th>Select</th>
            <th>Display ID</th>
            <th>Car Model</th>
            <th>Display Type</th>
            <th>Screen Size (Inches)</th>
            <th>Resolution</th>
            <th>Display Position</th>
            <th>Touch Screen</th>
            <th>Multi-Touch</th>
            <th>Color Depth</th>
            <th>Display Brand</th>
            <th>Infotainment Integration</th>
            <th>Voice Control</th>
            <th>Navigation System</th>
            <th>Smartphone Integration</th>
            <th>Rearview Camera</th>
            <th>Wireless Connectivity</th>
            <th>Bluetooth Connectivity</th>
            <th>HDMI Input</th>
            <th>USB Ports</th>
            <th>Cost Estimate (USD)</th>
            <th>Warranty (Years)</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><input type='checkbox' name='display_ids[]' value='" . $row['display_id'] . "'></td>";
                echo "<td>" . htmlspecialchars($row['display_id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['car_model']) . "</td>";
                echo "<td>" . htmlspecialchars($row['display_type']) . "</td>";
                echo "<td>" . htmlspecialchars($row['screen_size_inch']) . "</td>";
                echo "<td>" . htmlspecialchars($row['resolution']) . "</td>";
                echo "<td>" . htmlspecialchars($row['display_position']) . "</td>";
                echo "<td>" . ($row['touch_screen'] ? 'Yes' : 'No') . "</td>";
                echo "<td>" . ($row['multi_touch'] ? 'Yes' : 'No') . "</td>";
                echo "<td>" . htmlspecialchars($row['display_color_depth']) . "</td>";
                echo "<td>" . htmlspecialchars($row['display_brand']) . "</td>";
                echo "<td>" . ($row['infotainment_integration'] ? 'Yes' : 'No') . "</td>";
                echo "<td>" . ($row['voice_control'] ? 'Yes' : 'No') . "</td>";
                echo "<td>" . ($row['navigation_system'] ? 'Yes' : 'No') . "</td>";
                echo "<td>" . ($row['smartphone_integration'] ? 'Yes' : 'No') . "</td>";
                echo "<td>" . ($row['rearview_camera'] ? 'Yes' : 'No') . "</td>";
                echo "<td>" . ($row['wireless_connectivity'] ? 'Yes' : 'No') . "</td>";
                echo "<td>" . ($row['bluetooth_connectivity'] ? 'Yes' : 'No') . "</td>";
                echo "<td>" . ($row['HDMI_input'] ? 'Yes' : 'No') . "</td>";
                echo "<td>" . htmlspecialchars($row['USB_ports']) . "</td>";
                echo "<td>" . htmlspecialchars($row['cost_estimate_usd']) . "</td>";
                echo "<td>" . htmlspecialchars($row['warranty_years']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='22'>No car display systems available.</td></tr>";
        }
        ?>
      </tbody>
    </table>

    <button type="submit" name="add_to_cart" class="cta-button">Add to Cart</button>
</form>

</body>
</html>
