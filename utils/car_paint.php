<?php
session_start();  // Start session to manage cart
include '../db_connection.php';

// Handle the form submission to add selected car paint options to the cart
if (isset($_POST['add_to_cart'])) {
  if (!isset($_SESSION['cart']['car_paint'])) {
      $_SESSION['cart']['car_paint'] = [];  // Initialize car paint array
  }

  foreach ($_POST['paint_ids'] as $paint_id) {
      // Avoid duplicates in the cart
      if (!in_array($paint_id, $_SESSION['cart']['car_paint'])) {
          $_SESSION['cart']['car_paint'][] = $paint_id;  // Add to car paint
      }
  }

  header('Location: ../user_dashboard.php');
  exit();
}

// Fetch all car paint options
$sql = "SELECT * FROM car_paint";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>EV Company - Car Paint Overview</title>
  <link rel="stylesheet" href="./common_styles.css">
</head>
<body>

<form action="car_paint.php" method="POST">
    <table>
      <thead>
        <tr>
            <th>Select</th>
            <th>Paint ID</th>
            <th>Car Model</th>
            <th>Paint Color</th>
            <th>Color Code</th>
            <th>Paint Type</th>
            <th>Finish Type</th>
            <th>Brand</th>
            <th>Is Metallic</th>
            <th>Is Pearlescent</th>
            <th>Cost Estimate (USD)</th>
            <th>Warranty (Years)</th>
            <th>Durability Rating</th>
            <th>Weather Resistance</th>
            <th>UV Protection</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td><input type='checkbox' name='paint_ids[]' value='" . $row['paint_id'] . "'></td>";
                echo "<td>" . htmlspecialchars($row['paint_id']) . "</td>";
                echo "<td>" . htmlspecialchars($row['car_model']) . "</td>";
                echo "<td>" . htmlspecialchars($row['paint_color']) . "</td>";
                echo "<td>" . htmlspecialchars($row['color_code']) . "</td>";
                echo "<td>" . htmlspecialchars($row['paint_type']) . "</td>";
                echo "<td>" . htmlspecialchars($row['finish_type']) . "</td>";
                echo "<td>" . htmlspecialchars($row['brand']) . "</td>";
                echo "<td>" . ($row['is_metallic'] ? 'Yes' : 'No') . "</td>";
                echo "<td>" . ($row['is_perlescent'] ? 'Yes' : 'No') . "</td>";
                echo "<td>" . htmlspecialchars($row['cost_estimate_usd']) . "</td>";
                echo "<td>" . htmlspecialchars($row['warranty_years']) . "</td>";
                echo "<td>" . htmlspecialchars($row['durability_rating']) . "</td>";
                echo "<td>" . ($row['weather_resistance'] ? 'Yes' : 'No') . "</td>";
                echo "<td>" . ($row['UV_protection'] ? 'Yes' : 'No') . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='15'>No car paint options available.</td></tr>";
        }
        ?>
      </tbody>
    </table>

    <button type="submit" name="add_to_cart" class="cta-button">Add to Cart</button>
</form>

</body>
</html>
