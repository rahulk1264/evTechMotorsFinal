<?php
session_start();  // Start session to manage cart
include '../db_connection.php';

// Handle the form submission to add selected music systems to the cart
if (isset($_POST['add_to_cart'])) {
    if (!isset($_SESSION['cart']['music_system'])) {
        $_SESSION['cart']['music_system'] = [];  // Initialize music systems array
    }

    foreach ($_POST['system_ids'] as $system_id) {
        // Avoid duplicates in the cart
        if (!in_array($system_id, $_SESSION['cart']['music_system'])) {
            $_SESSION['cart']['music_system'][] = $system_id;  // Add to music systems cart
        }
    }

    header('Location: ../user_dashboard.php');
    exit();
}

// Fetch all music systems
$sql = "SELECT * FROM music_system";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EV Company - Music System Overview</title>
    <link rel="stylesheet" href="./common_styles.css">
</head>
<body>

<form action="music_system.php" method="POST">
    <table>
        <thead>
            <tr>
                <th>Select</th>
                <th>System ID</th>
                <th>Brand</th>
                <th>Model Name</th>
                <th>Speaker Count</th>
                <th>Tweeters</th>
                <th>Subwoofer</th>
                <th>Amplifier Power (Watts)</th>
                <th>Total Output Power (Watts)</th>
                <th>Audio Format Support</th>
                <th>Connectivity Options</th>
                <th>Touchscreen Display Size</th>
                <th>Equalizer Options</th>
                <th>Noise Cancellation</th>
                <th>Voice Control</th>
                <th>Compatibility</th>
                <th>OTA Updates</th>
                <th>UI Customizable</th>
                <th>Sound Modes</th>
                <th>3D Sound Support</th>
                <th>Placement Notes</th>
                <th>Cost Estimate (USD)</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><input type='checkbox' name='system_ids[]' value='" . $row['system_id'] . "'></td>";
                    echo "<td>" . htmlspecialchars($row['system_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['brand']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['model_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['speaker_count']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['tweeters']) . "</td>";
                    echo "<td>" . ($row['subwoofer'] ? "Yes" : "No") . "</td>";
                    echo "<td>" . htmlspecialchars($row['amplifier_power_watts']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['total_output_power_watts']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['audio_format_support']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['connectivity_options']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['touchscreen_display_size']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['equalizer_options']) . "</td>";
                    echo "<td>" . ($row['noise_cancellation'] ? "Yes" : "No") . "</td>";
                    echo "<td>" . ($row['voice_control'] ? "Yes" : "No") . "</td>";
                    echo "<td>" . htmlspecialchars($row['compatibility']) . "</td>";
                    echo "<td>" . ($row['ota_updates'] ? "Yes" : "No") . "</td>";
                    echo "<td>" . ($row['ui_customizable'] ? "Yes" : "No") . "</td>";
                    echo "<td>" . htmlspecialchars($row['sound_modes']) . "</td>";
                    echo "<td>" . ($row['3d_sound_support'] ? "Yes" : "No") . "</td>";
                    echo "<td>" . htmlspecialchars($row['placement_notes']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['cost_estimate_usd']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='21'>No music systems available.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <button type="submit" name="add_to_cart" class="cta-button">Add to Cart</button>
</form>

</body>
</html>
