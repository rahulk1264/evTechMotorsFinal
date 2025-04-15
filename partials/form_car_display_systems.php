<form method="POST" action="" class="crud-form">
<?php if ($_GET['operation'] != 'delete'): ?>
    <label>Car Model:</label>
    <input type="text" name="car_model" required>

    <label>Display Type:</label>
    <input type="text" name="display_type" required>

    <label>Screen Size (Inch):</label>
    <input type="number" name="screen_size_inch" required>

    <label>Resolution:</label>
    <input type="text" name="resolution" required>

    <label>Display Position:</label>
    <input type="text" name="display_position" required>

    <label>Touch Screen:</label>
    <select name="touch_screen" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>

    <label>Multi-Touch:</label>
    <select name="multi_touch" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>

    <label>Display Color Depth:</label>
    <input type="number" name="display_color_depth" required>

    <label>Display Brand:</label>
    <input type="text" name="display_brand" required>

    <label>Infotainment Integration:</label>
    <select name="infotainment_integration" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>

    <label>Voice Control:</label>
    <select name="voice_control" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>

    <label>Navigation System:</label>
    <select name="navigation_system" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>

    <label>Smartphone Integration:</label>
    <select name="smartphone_integration" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>

    <label>Rearview Camera:</label>
    <select name="rearview_camera" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>

    <label>Wireless Connectivity:</label>
    <select name="wireless_connectivity" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>

    <label>Bluetooth Connectivity:</label>
    <select name="bluetooth_connectivity" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>

    <label>HDMI Input:</label>
    <select name="HDMI_input" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>

    <label>USB Ports:</label>
    <input type="number" name="USB_ports" required>

    <label>Cost Estimate (USD):</label>
    <input type="number" step="0.01" name="cost_estimate_usd" required>

    <label>Warranty Years:</label>
    <input type="number" name="warranty_years" required>
<?php else: ?>
    <label>Display ID:</label>
    <input type="number" name="id" required>
<?php endif; ?>

    <button type="submit" name="submit">Submit</button>
</form>

<?php
if (isset($_POST['submit'])) {
    $operation = $_GET['operation'];

    if ($operation == "add") {
        $columns = "car_model, display_type, screen_size_inch, resolution, display_position, touch_screen, multi_touch, display_color_depth, display_brand, infotainment_integration, voice_control, navigation_system, smartphone_integration, rearview_camera, wireless_connectivity, bluetooth_connectivity, HDMI_input, USB_ports, cost_estimate_usd, warranty_years";
        $values = "'$_POST[car_model]', '$_POST[display_type]', '$_POST[screen_size_inch]', '$_POST[resolution]', '$_POST[display_position]', '$_POST[touch_screen]', '$_POST[multi_touch]', '$_POST[display_color_depth]', '$_POST[display_brand]', '$_POST[infotainment_integration]', '$_POST[voice_control]', '$_POST[navigation_system]', '$_POST[smartphone_integration]', '$_POST[rearview_camera]', '$_POST[wireless_connectivity]', '$_POST[bluetooth_connectivity]', '$_POST[HDMI_input]', '$_POST[USB_ports]', '$_POST[cost_estimate_usd]', '$_POST[warranty_years]'";
        $query = "INSERT INTO car_display_systems ($columns) VALUES ($values)";
    } elseif ($operation == "update") {
        $id = $_GET['id'] ?? 0;
        $query = "UPDATE car_display_systems SET 
                    car_model='$_POST[car_model]',
                    display_type='$_POST[display_type]',
                    screen_size_inch='$_POST[screen_size_inch]',
                    resolution='$_POST[resolution]',
                    display_position='$_POST[display_position]',
                    touch_screen='$_POST[touch_screen]',
                    multi_touch='$_POST[multi_touch]',
                    display_color_depth='$_POST[display_color_depth]',
                    display_brand='$_POST[display_brand]',
                    infotainment_integration='$_POST[infotainment_integration]',
                    voice_control='$_POST[voice_control]',
                    navigation_system='$_POST[navigation_system]',
                    smartphone_integration='$_POST[smartphone_integration]',
                    rearview_camera='$_POST[rearview_camera]',
                    wireless_connectivity='$_POST[wireless_connectivity]',
                    bluetooth_connectivity='$_POST[bluetooth_connectivity]',
                    HDMI_input='$_POST[HDMI_input]',
                    USB_ports='$_POST[USB_ports]',
                    cost_estimate_usd='$_POST[cost_estimate_usd]',
                    warranty_years='$_POST[warranty_years]'
                  WHERE display_id=$id";
    } elseif ($operation == "delete") {
        $id = $_POST['id'];
        $query = "DELETE FROM car_display_systems WHERE display_id=$id";
    }

    if (mysqli_query($conn, $query)) {
        echo "<p class='success-msg'>Operation successful!</p>";
    } else {
        echo "<p class='error-msg'>Error: " . mysqli_error($conn) . "</p>";
    }
}
?>
