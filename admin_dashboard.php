<?php include 'db_connection.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="./partials/styles/common_styles.css">
</head>
<body>

<header class="navbar">
  <div class="navbar-container">
    <div class="logo">
      <h1>EVTech Motors</h1>
      <p>Your hub for smart electric vehicle components</p>
    </div>
    <nav class="nav-links">
      
      <a href="contact.html">Ticket</a>
      <a href="user_login.html">Profile</a>
      <a href="./index.php">Logout</a>
    </nav>
  </div>
</header>



<div class="container table-container">
    <h2>Admin Dashboard</h2>

    <form method="GET" action="" class="selector-form">
        <label for="table">Select Table:</label>
        <select name="table" required>
            <option value="">--Choose a Table--</option>
            <option value="battery">Battery</option>
            <option value="car_ac_systems">Car AC System</option>
            <option value="car_chassis">Car Chassis</option>
            <option value="car_display_systems">Car Display System</option>
            <option value="car_interior_design">Car Interior Design</option>
            <option value="car_paint">Car Paint</option>
            <option value="music_system">Music System</option>
            <option value="wheels">Wheels</option>
        </select>

        <label for="operation">Select Operation:</label>
        <select name="operation" required>
            <option value="">--Choose an Operation--</option>
            <option value="add">Add</option>
            <option value="update">Update</option>
            <option value="delete">Delete</option>
            <option value="display">Display All</option>
        </select>

        <button type="submit">Proceed</button>
    </form>

    <?php
    if (isset($_GET['table']) && isset($_GET['operation'])) {
        $table = $_GET['table'];
        $operation = $_GET['operation'];
        $file_path = "partials/form_{$table}.php";

        if ($operation == "display") {
            $query = "SELECT * FROM $table";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                echo "<table class='data-table '><tr>";
                while ($field = mysqli_fetch_field($result)) {
                    echo "<th>{$field->name}</th>";
                }
                echo "</tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    foreach ($row as $data) {
                        echo "<td>{$data}</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>No data found.</p>";
            }
        } else {
            if (file_exists($file_path)) {
                include $file_path;
            } else {
                echo "<p>No form found for $table</p>";
            }
        }
    }
    ?>
</div>

<footer>
  <div class="footer-container">
    <div class="footer-info">
      <h3>EVTech Motors</h3>
      <p>123 Electric Avenue, Green City, IN 600045</p>
      <p>Phone: +1 (800) 555-1234</p>
      <p>Email: support@evtechmotors.com</p>
    </div>

    <div class="footer-links">
      <h4>Quick Links</h4>
      <ul>
        <li><a href="#">Privacy Policy</a></li>
        <li><a href="#">Terms of Use</a></li>
        <li><a href="#">User Agreement</a></li>
        <li><a href="#">Sitemap</a></li>
      </ul>
    </div>

    <div class="footer-social">
      <h4>Connect With Us</h4>
      <p>
        <a href="#">LinkedIn</a> |
        <a href="#">Twitter</a> |
        <a href="#">Facebook</a>
      </p>
    </div>
  </div>

  <div class="footer-bottom">
    <p>&copy; 2025 EVTech Motors. All rights reserved.</p>
    <p>Powered by FutureDrive™ Technologies</p>
  </div>
</footer>
</body>


</html>