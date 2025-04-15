<?php include 'db_connection.php';
  session_start();

  // Check if user is logged in by the email and userid
  if (!isset($_SESSION['userid'])) {
      header("Location: user_login.html"); // Redirect to login page if not logged in
      exit();
  }



  $user_id = $_SESSION['userid'];
  $user_name = $_SESSION['name'];
  $user_email = $_SESSION['email'];

  if (isset($_POST['empty_cart'])) {
    unset($_SESSION['cart']);
}

  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>EV Company - Battery Overview</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      background-color: black;
      font-family: Arial, sans-serif;
    }

    .spline-section {
      height: 100vh;
      width: 100%;
      background-color: black;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      
      box-sizing: border-box;
    }
.spline-section h1 {
      color: black;
      font-size: 1.6rem;
      font-weight: normal;
      padding: 10px;
      background: white;
     background-color: #ffcc00;
      border-radius: 10px;
      text-align: center;
      box-shadow: 0 5px 15px rgba(255, 204, 0, 0.4);
    }
    
    .spline-container {
      width: 100%;
      
      height: 90vh;
      
      overflow: hidden;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .spline-container iframe {
      width: 100%;
      height: 100%;
      border: none;
    }

    .cta-section {
  background-color: #000000;
  color: white;
  padding: 60px 20px;
  text-align: center;
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 75vh;
  border-radius: 16px;
  margin: 40px 20px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
}

.cta-content {
  max-width: 700px;
}

.cta-content h2 {
  font-size: 2.5rem;
  margin-bottom: 10px;
}

.cta-content p {
  font-size: 1.1rem;
  margin-bottom: 25px;
  font-weight:bold;
}

.cta-button {
  background-color: #ffcc00;
  color: #1e1e1e;
  padding: 15px 30px;
  font-size: 1.1rem;
  font-weight: bold;
  border: none;
  border-radius: 8px;
  text-decoration: none;
  transition: all 0.3s ease;
  box-shadow: 0 5px 15px rgba(255, 204, 0, 0.22);
}

.cta-button:hover {
  background-color: #ffdb4d;
  transform: translateY(-3px);
  box-shadow: 0 8px 20px rgba(255, 204, 0, 0.5);
}

/* Responsive */
@media (max-width: 768px) {
  .cta-content h2 {
    font-size: 2rem;
  }

  .cta-content p {
    font-size: 1rem;
  }

  .cta-button {
    font-size: 1rem;
    padding: 12px 24px;
  }
}




    
  </style>
</head>
<body>

<header class="navbar">
  <div class="navbar-container">
    <div class="logo">
      <h1>EVTech Motors</h1>
      <p>Your hub for smart electric vehicle components</p>
    </div>
    <nav class="nav-links">
      
      <a href="">Ticket</a>
      <a href="./utils/user_orders.php">My Orders</a>
      <a href="./index.php">Logout</a>
    </nav>
  </div>
</header>
<body>


  <section class="cta-section">
  <div class="cta-content">
  <h2 style="color: white;">Welcome, <?php echo htmlspecialchars($user_name); ?>!</h2>
    <h2>Build Your Dream Ride</h2>
    <p>Customize every detail of your electric vehicle and bring your vision to life.</p>
    <a href="./utils/battery.php" class="cta-button">Assemble Your Car</a>
  </div>
</section>

<section class="spline-section">
    <h1 style="color: white;">Explore the Future of Autonomous Vehicles</h1>
    <p style="color: white;">Interact with the 3D model below to see the innovative features up close.</p>
    <p style="color: white;">Click and drag to rotate the model.</p>
    <div class="spline-container"> 
     
       <iframe src="https://my.spline.design/zooxautonomousvehicle-kr3MvxnMW1FnSrxUh7du4BFw/" allowfullscreen></iframe>
    </div>
  </section>
  
<!-- Cart Button -->
<div style="margin-top: 80px;">
    
    <form action="user_dashboard.php" method="POST" style="background-color: black; ">
      <h2>Add items to your cart:</h2>
        <button type="submit" name="empty_cart" class="cta-button">Empty Cart</button>
        <a href="./utils/battery.php" class="cta-button">Batteries</a>
        <a href="./utils/car_ac_systems.php" class="cta-button">AC systems</a>
        <a href="./utils/car_chassis.php" class="cta-button">Chassis</a>
        <a href="./utils/car_display_systems.php" class="cta-button">Display</a>
        <a href="./utils/car_interior_design.php" class="cta-button">Interior</a>
        <a href="./utils/car_paint.php" class="cta-button">Paint</a>
        <a href="./utils/music_system.php" class="cta-button">Music</a>
        <a href="./utils/wheels.php" class="cta-button">Wheels</a>
    </form>
</div>


<div style="display: flex;flex-direction:column ;align-items: center; justify-content: center; margin-top: 20px; background-color: black; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
    <img src="./public/shopping-cart.png" alt="Cart Icon" style="width: 50px; height: 50px; margin-right: 20px;">
    
<h2>Your Cart</h2>
    <p>Items in your cart: <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?></p>
</div>


<table>
  <thead>
    <tr>
      <?php
        
        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
          echo "<th>Item_id</th>";
          echo "<th>Item_details</th>";
          echo "<th>Item_cost</th>";
        }
      ?>
    </tr>
    
  </thead>
        <tbody>
        <?php
// Display cart items if they exist
if (isset($_SESSION['cart']) && (isset($_SESSION['cart']['battery']) || isset($_SESSION['cart']['ac_systems']))) {
  
  
  if (isset($_SESSION['cart']['battery']) && count($_SESSION['cart']['battery']) > 0) {
      foreach ($_SESSION['cart']['battery'] as $battery_id) {
        $battery_query = "SELECT * FROM battery WHERE battery_id = $battery_id";
        $battery_result = $conn->query($battery_query);

        if ($battery_result && $battery_result->num_rows > 0) {
            $battery = $battery_result->fetch_assoc();
            echo "<tr>";
            echo "<td>" . $battery['battery_id'] . "</td>";
            echo "<td>" . $battery['model_name'] . "</td>";
            echo "<td>$" . $battery['cost_estimate_usd'] . "</td>";
            echo "</tr>";
        }
      }
    
  }

  if (isset($_SESSION['cart']['car_ac_systems']) && count($_SESSION['cart']['car_ac_systems']) > 0) {
      foreach ($_SESSION['cart']['car_ac_systems'] as $ac_id) {
        $ac_query = "SELECT * FROM car_ac_systems WHERE ac_id = $ac_id";
        $ac_result = $conn->query($ac_query);

        if ($ac_result && $ac_result->num_rows > 0) {
            $ac_system = $ac_result->fetch_assoc();
            echo "<tr>";
            echo "<td>" . $ac_system['ac_id'] . "</td>";
            echo "<td>" . $ac_system['car_model'] . "</td>";
            echo "<td>$" . $ac_system['cost_estimate_usd'] . "</td>";
            echo "</tr>";
        }
      }
  }

  if (isset($_SESSION['cart']['car_chassis']) && count($_SESSION['cart']['car_chassis']) > 0) {
      foreach ($_SESSION['cart']['car_chassis'] as $chassis_id) {
        $chassis_query = "SELECT * FROM car_chassis WHERE chassis_id = $chassis_id";
        $chassis_result = $conn->query($chassis_query);

        if ($chassis_result && $chassis_result->num_rows > 0) {
            $car_chassis = $chassis_result->fetch_assoc();
            echo "<tr>";
            echo "<td>" . $car_chassis['chassis_id'] . "</td>";
            echo "<td>" . $car_chassis['car_model'] . "</td>";
            echo "<td>$" . $car_chassis['cost_estimate_usd'] . "</td>";

            echo "</tr>";
        }
      }
  }

  if (isset($_SESSION['cart']['car_display_systems']) && count($_SESSION['cart']['car_display_systems']) > 0) {
    foreach ($_SESSION['cart']['car_display_systems'] as $display_id) {
      $display_query = "SELECT * FROM car_display_systems WHERE display_id = $display_id";
      $display_result = $conn->query($display_query);

      if ($display_result && $display_result->num_rows > 0) {
          $car_display = $display_result->fetch_assoc();
          echo "<tr>";
          echo "<td>" . $car_display['display_id'] . "</td>";
          echo "<td>" . $car_display['car_model'] . "</td>";
          echo "<td>$" . $car_display['cost_estimate_usd'] . "</td>";

          echo "</tr>";
      }
    }
  }

  if (isset($_SESSION['cart']['car_interior_design']) && count($_SESSION['cart']['car_interior_design']) > 0) {
    foreach ($_SESSION['cart']['car_interior_design'] as $interior_id) {
      $interior_query = "SELECT * FROM car_interior_design WHERE interior_id = $interior_id";
      $interior_result = $conn->query($interior_query);

      if ($interior_result && $interior_result->num_rows > 0) {
          $car_interior = $interior_result->fetch_assoc();
          echo "<tr>";
          echo "<td>" . $car_interior['interior_id'] . "</td>";
          echo "<td>" . $car_interior['car_model'] . "</td>";
          echo "<td>" . $car_interior['seat_material'] . "</td>";
          echo "</tr>";
      }
    }
  }

  if (isset($_SESSION['cart']['car_paint']) && count($_SESSION['cart']['car_paint']) > 0) {
    foreach ($_SESSION['cart']['car_paint'] as $paint_id) {
      $paint_query = "SELECT * FROM car_paint WHERE paint_id = $paint_id";
      $paint_result = $conn->query($paint_query);

      if ($paint_result && $paint_result->num_rows > 0) {
          $car_paint = $paint_result->fetch_assoc();
          echo "<tr>";
          echo "<td>" . $car_paint['paint_id'] . "</td>";
          echo "<td>" . $car_paint['car_model'] . "</td>";
          echo "<td>" . $car_paint['paint_color'] . "</td>";
          echo "</tr>";
      }
    }
  }

  if (isset($_SESSION['cart']['music_system']) && count($_SESSION['cart']['music_system']) > 0) {
    foreach ($_SESSION['cart']['music_system'] as $system_id) {
      $system_query = "SELECT * FROM music_system WHERE system_id = $system_id";
      $system_result = $conn->query($system_query);

      if ($system_result && $system_result->num_rows > 0) {
          $music_system = $system_result->fetch_assoc();
          echo "<tr>";
          echo "<td>" . $music_system['system_id'] . "</td>";
          echo "<td>" . $music_system['brand'] . "</td>";
          echo "<td>" . $music_system['model_name'] . "</td>";
          echo "</tr>";
      }
    }
  }

  if (isset($_SESSION['cart']['wheels']) && count($_SESSION['cart']['wheels']) > 0) {
    foreach ($_SESSION['cart']['wheels'] as $wheel_id) {
      $wheel_query = "SELECT * FROM wheels WHERE wheel_id = $wheel_id";
      $wheel_result = $conn->query($wheel_query);

      if ($wheel_result && $wheel_result->num_rows > 0) {
          $wheels = $wheel_result->fetch_assoc();
          echo "<tr>";
          echo "<td>" . $wheels['wheel_id'] . "</td>";
          echo "<td>" . $wheels['car_model'] . "</td>";
          echo "<td>" . $wheels['brand'] . "</td>";
          echo "</tr>";
      }
    }
  }
  
 
} else {
  echo "<p>Your cart is empty!</p>";
}

?>
            
        </tbody>

</table>

    <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
    <form action="./utils/place_order.php" method="POST">
        <button type="submit" name="place_order" class="cta-button">Place Order</button>
    </form>
    <?php endif; ?>

</body>

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
