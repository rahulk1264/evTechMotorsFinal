<?php include 'db_connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>EV Company - Battery Overview</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="navbar">
  <div class="navbar-container">
    <div class="logo">
      <h1>EVTech Motors</h1>
      <p>Your hub for smart electric vehicle components</p>
    </div>
    <nav class="nav-links">
      <a href="about.html">About</a>
      <a href="contact.html">Contact Us</a>
      <a href="./helpers/user_login.php">User Login</a>
      <a href="./helpers/admin_login.php">Admin Login</a>
    </nav>
  </div>
</header>

  <main>

  <section class="ev-hero">
        <div class="ev-hero-text">
            <h1 style="color: black;">Drive Into the Future with Electric Vehicles</h1>
            <p style="color: black;">
                Electric vehicles are revolutionizing the automotive industry. With their silent operation, zero emissions, and cutting-edge technology, they are setting the standard for the future of transportation.
            </p>
            <a href="#assemble" class="cta-button">Assemble Your Car</a>
        </div>
    </section>



  <section class="hero">
        <div class="hero-text">
            <h1>Why Batteries Are Better Than Conventional Fuels</h1>
            <p>
                Battery-powered electric vehicles (EVs) offer a cleaner and more efficient alternative to traditional internal combustion engines. They produce zero tailpipe emissions, contributing significantly to reduced urban air pollution and global carbon footprint.
            </p>
            <p>
                Unlike conventional fuels, batteries can be charged using renewable energy sources, enabling a truly sustainable transportation system. Additionally, advancements in battery technology have drastically improved their range, lifespan, and affordability.
            </p>
        </div>
        <div class="hero-images">
            <!-- Replace these with actual images -->
            <div class="image-placeholder"> </div>
            <div class="image-placeholder"></div>
        </div>
    </section>
    



  <h2>Our Hi-Tech Battery Specifications</h2>
  <div class="table-container">
    <table>
      <thead>
      <tr>
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
        $sql = "SELECT * FROM battery";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $data) {
              echo "<td>" . htmlspecialchars($data) . "</td>";
            }
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='20'>No data available</td></tr>";
        }

        $conn->close();
        ?>
      </tbody>
    </table>
  </div>


 <!-- contact us section -->
  <section class="contact-section" id="contact">
  <h2>Contact Us</h2>
  <p>Have questions or want to inquire about custom EV battery configurations? Fill out the form below.</p>

  <form action="mailto:evtech@example.com" method="POST" enctype="text/plain">
    <!-- General Information -->
    <div class="form-group">
      <label for="name">Full Name*</label>
      <input type="text" id="name" name="Name" required>
    </div>

    <div class="form-group">
      <label for="email">Email Address*</label>
      <input type="email" id="email" name="Email" required>
    </div>

    <div class="form-group">
      <label for="phone">Phone Number</label>
      <input type="tel" id="phone" name="Phone">
    </div>

    <!-- Battery Preferences -->
    <div class="form-group">
      <label for="manufacturer">Preferred Manufacturer</label>
      <input type="text" id="manufacturer" name="Preferred Manufacturer">
    </div>

    <div class="form-group">
      <label for="chemistry">Battery Chemistry</label>
      <select id="chemistry" name="Battery Chemistry">
        <option value="">Select...</option>
        <option value="Lithium-Ion">Lithium-Ion</option>
        <option value="LFP">LFP</option>
        <option value="NMC">NMC</option>
        <option value="Solid-State">Solid-State</option>
      </select>
    </div>

    <div class="form-group">
      <label for="capacity">Desired Capacity (kWh)</label>
      <input type="number" id="capacity" name="Capacity kWh" min="1" step="0.1">
    </div>

    <div class="form-group">
      <label for="charging">Need Fast Charging?</label>
      <select id="charging" name="Fast Charging">
        <option value="">Select...</option>
        <option value="Yes">Yes</option>
        <option value="No">No</option>
      </select>
    </div>

    <div class="form-group">
      <label for="message">Additional Message</label>
      <textarea id="message" name="Message" rows="5"></textarea>
    </div>

    <button type="submit">Submit Inquiry</button>
  </form>
</section>



</main>


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
