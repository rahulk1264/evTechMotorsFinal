<?php
session_start();  // Start session to manage cart
include '../db_connection.php';

// Handle the form submission to add selected car interior designs to the cart
if (isset($_POST['add_to_cart'])) {
  if (!isset($_SESSION['cart']['car_interior_design'])) {
      $_SESSION['cart']['car_interior_design'] = [];  // Initialize car interior design array
  }

  foreach ($_POST['interior_ids'] as $interior_id) {
      // Avoid duplicates in the cart
      if (!in_array($interior_id, $_SESSION['cart']['car_interior_design'])) {
          $_SESSION['cart']['car_interior_design'][] = $interior_id;  // Add to car interior design
      }
  }

  header('Location: ../user_dashboard.php');
  exit();
}

// Fetch all car interior designs
$sql = "SELECT * FROM car_interior_design";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>EV Company - Car Interior Design Overview</title>
  <link rel="stylesheet" href="./common_styles.css">
</head>
<body>

<form action="car_interior_design.php" method="POST">
    <table>
      <thead>
        <tr>
            <th>Select</th>
            <th>Interior ID</th>
            <th>Car Model</th>
            <th>Seat Material</th>
            <th>Seat Color</th>
            <th>Dashboard Material</th>
            <th>Dashboard Color</th>
            <th>Flooring Material</th>
            <th>Flooring Color</th>
            <th>Trim Material</th>
            <th>Trim Color</th>
            <th>Steering Wheel Material</th>
            <th>Steering Wheel Color</th>
            <th>Ambient Lighting</th>
            <th>Infotainment System</th>
            <th>Sound System</th>
            <th>Seat Adjustment Type</th>
            <th>Seat Heating</th>
            <th>Seat Cooling</th>
            <th>Cup Holder Count</th>
            <th>Sunroof</th>
            <th>Climate Control</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><input type='checkbox' name='interior_ids[]' value='" . $row['interior_id'] . "'></td>";
                echo "<td>" . htmlspecialchars($row['interior_id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['car_model']) . "</td>";
                echo "<td>" . htmlspecialchars($row['seat_material']) . "</td>";
                echo "<td>" . htmlspecialchars($row['seat_color']) . "</td>";
                echo "<td>" . htmlspecialchars($row['dashboard_material']) . "</td>";
                echo "<td>" . htmlspecialchars($row['dashboard_color']) . "</td>";
                echo "<td>" . htmlspecialchars($row['flooring_material']) . "</td>";
                echo "<td>" . htmlspecialchars($row['flooring_color']) . "</td>";
                echo "<td>" . htmlspecialchars($row['trim_material']) . "</td>";
                echo "<td>" . htmlspecialchars($row['trim_color']) . "</td>";
                echo "<td>" . htmlspecialchars($row['steering_wheel_material']) . "</td>";
                echo "<td>" . htmlspecialchars($row['steering_wheel_color']) . "</td>";
                echo "<td>" . ($row['ambient_lighting'] ? 'Yes' : 'No') . "</td>";
                echo "<td>" . ($row['infotainment_system'] ? 'Yes' : 'No') . "</td>";
                echo "<td>" . ($row['sound_system'] ? 'Yes' : 'No') . "</td>";
                echo "<td>" . htmlspecialchars($row['seat_adjustment_type']) . "</td>";
                echo "<td>" . ($row['seat_heating'] ? 'Yes' : 'No') . "</td>";
                echo "<td>" . ($row['seat_cooling'] ? 'Yes' : 'No') . "</td>";
                echo "<td>" . htmlspecialchars($row['cup_holder_count']) . "</td>";
                echo "<td>" . ($row['sunroof'] ? 'Yes' : 'No') . "</td>";
                echo "<td>" . ($row['climate_control'] ? 'Yes' : 'No') . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='22'>No car interior designs available.</td></tr>";
        }
        ?>
      </tbody>
    </table>

    <button type="submit" name="add_to_cart" class="cta-button">Add to Cart</button>
</form>

</body>
</html>
