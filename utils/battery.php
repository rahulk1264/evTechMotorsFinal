<?php
session_start();  // Start session to manage cart
include '../db_connection.php';

// Handle the form submission to add selected battery to the cart
if (isset($_POST['add_to_cart'])) {
  if (!isset($_SESSION['cart']['battery'])) {
      $_SESSION['cart']['battery'] = [];  // Initialize battery array
  }

  foreach ($_POST['battery_ids'] as $battery_id) {
      // Avoid duplicates in the cart
      if (!in_array($battery_id, $_SESSION['cart']['battery'])) {
          $_SESSION['cart']['battery'][] = $battery_id;  // Add to battery
      }
  }

  header('Location: ../user_dashboard.php');
  exit();
}


// Fetch all battery
$sql = "SELECT * FROM battery";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>EV Company - Battery Overview</title>
  <link rel="stylesheet" href="./common_styles.css">
</head>
<body>



<form action="battery.php" method="POST">
    <table>
      <thead>
        <tr>
            <th>Select</th>
            <th>battery_id</th>
                    <th>manufacturer</th>
                    <th>model_name</th>
                    <th>chemistry</th>
                    <th>capacity_kWh</th>
                    <th>usable_capacity_kWh</th>
                    <th>voltage</th>
                    <th>modules</th>
                    <th>cells</th>
                    <th>cell_type</th>
                    <th>max_charging_power_kW</th>
                    <th>max_discharging_power_kW</th>
                    <th>charging_time_10_80_min</th>
                    <th>range_km</th>
                    <th>efficiency_km_per_kWh</th>
                    <th>degradation_per_10000km</th>
                    <th>cycles_before_80_percent</th>
                    <th>battery_management_system</th>
                    <th>thermal_management</th>
                    <th>active_cooling</th>
                    <th>passive_cooling</th>
                    <th>fast_charging_support</th>
                    <th>wireless_charging_support</th>
                    <th>swappable</th>
                    <th>placement</th>
                    <th>waterproof_rating</th>
                    <th>fire_protection</th>
                    <th>safety_certifications</th>
                    <th>smart_bms</th>
                    <th>remote_monitoring</th>
                    <th>temperature_range</th>
                    <th>cost_estimate_usd</th>

        </tr>
      </thead>
      <tbody>
        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><input type='checkbox' name='battery_ids[]' value='" . $row['battery_id'] . "'></td>";
                echo "<td>" . htmlspecialchars($row['battery_id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['manufacturer']) . "</td>";
                echo "<td>" . htmlspecialchars($row['model_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['chemistry']) . "</td>";
                echo "<td>" . htmlspecialchars($row['capacity_kWh']) . "</td>";
                echo "<td>" . htmlspecialchars($row['usable_capacity_kWh']) . "</td>";
                echo "<td>" . htmlspecialchars($row['voltage']) . "</td>";
                echo "<td>" . htmlspecialchars($row['modules']) . "</td>";
                echo "<td>" . htmlspecialchars($row['cells']) . "</td>";
                echo "<td>" . htmlspecialchars($row['cell_type']) . "</td>";
                echo "<td>" . htmlspecialchars($row['max_charging_power_kW']) . "</td>";
                echo "<td>" . htmlspecialchars($row['max_discharging_power_kW']) . "</td>";
                echo "<td>" . htmlspecialchars($row['charging_time_10_80_min']) . "</td>";
                echo "<td>" . htmlspecialchars($row['range_km']) . "</td>";
                echo "<td>" . htmlspecialchars($row['efficiency_km_per_kWh']) . "</td>";
                echo "<td>" . htmlspecialchars($row['degradation_per_10000km']) . "</td>";
                echo "<td>" . htmlspecialchars($row['cycles_before_80_percent']) . "</td>";
                echo "<td>" . htmlspecialchars($row['battery_management_system']) . "</td>";
                echo "<td>" . htmlspecialchars($row['thermal_management']) . "</td>";
                echo "<td>" . htmlspecialchars($row['active_cooling']) . "</td>";
                echo "<td>" . htmlspecialchars($row['passive_cooling']) . "</td>";
                echo "<td>" . htmlspecialchars($row['fast_charging_support']) . "</td>";
                echo "<td>" . htmlspecialchars($row['wireless_charging_support']) . "</td>";
                echo "<td>" . htmlspecialchars($row['swappable']) . "</td>";
                echo "<td>" . htmlspecialchars($row['placement']) . "</td>";
                echo "<td>" . htmlspecialchars($row['waterproof_rating']) . "</td>";
                echo "<td>" . htmlspecialchars($row['fire_protection']) . "</td>";
                echo "<td>" . htmlspecialchars($row['safety_certifications']) . "</td>";
                echo "<td>" . htmlspecialchars($row['smart_bms']) . "</td>";
                echo "<td>" . htmlspecialchars($row['remote_monitoring']) . "</td>";
                echo "<td>" . htmlspecialchars($row['temperature_range']) . "</td>";
                echo "<td>" . htmlspecialchars($row['cost_estimate_usd']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No battery available.</td></tr>";
        }
        ?>
      </tbody>
    </table>

    <button type="submit" name="add_to_cart" class="cta-button">Add to Cart</button>
</form>

</body>
</html>
