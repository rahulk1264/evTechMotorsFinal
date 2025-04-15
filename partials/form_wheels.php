<form method="POST" action="" class="crud-form">
<?php if ($_GET['operation'] != 'delete'): ?>
    <label>Car Model:</label>
    <input type="text" name="car_model" required>

    <label>Brand:</label>
    <input type="text" name="brand" required>

    <label>Type:</label>
    <input type="text" name="type" required>

    <label>Diameter (inches):</label>
    <input type="number" name="diameter" required>

    <label>Width (inches):</label>
    <input type="number" name="width" required>

    <label>Rim Material:</label>
    <input type="text" name="rim_material" required>

    <label>Tire Type:</label>
    <input type="text" name="tire_type" required>

    <label>Tire Brand:</label>
    <input type="text" name="tire_brand" required>

    <label>Tire Size:</label>
    <input type="text" name="tire_size" required>

    <label>Bolt Pattern:</label>
    <input type="text" name="bolt_pattern" required>

    <label>Offset (mm):</label>
    <input type="number" name="offset" required>

    <label>Load Index:</label>
    <input type="number" name="load_index" required>

    <label>Speed Rating:</label>
    <input type="text" name="speed_rating" required>

    <label>Air Pressure Max (psi):</label>
    <input type="number" name="air_pressure_max" required>

    <label>TPMS (Tire Pressure Monitoring System):</label>
    <select name="tire_pressure_monitoring_system" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>

    <label>Hub Diameter (mm):</label>
    <input type="number" name="hub_diameter" required>

    <label>Weight (kg):</label>
    <input type="number" name="weight" required>

    <label>Cost Estimate (USD):</label>
    <input type="number" step="0.01" name="cost_estimate_usd" required>
<?php else: ?>
    <label>Wheel ID:</label>
    <input type="number" name="id" required>
<?php endif; ?>

    <button type="submit" name="submit">Submit</button>
</form>

<?php
if (isset($_POST['submit'])) {
    $operation = $_GET['operation'];

    if ($operation == "add") {
        $columns = "car_model, brand, type, diameter, width, rim_material, tire_type, tire_brand, tire_size, bolt_pattern, offset, load_index, speed_rating, air_pressure_max, tire_pressure_monitoring_system, hub_diameter, weight, cost_estimate_usd";
        $values = "'$_POST[car_model]', '$_POST[brand]', '$_POST[type]', '$_POST[diameter]', '$_POST[width]', '$_POST[rim_material]', '$_POST[tire_type]', '$_POST[tire_brand]', '$_POST[tire_size]', '$_POST[bolt_pattern]', '$_POST[offset]', '$_POST[load_index]', '$_POST[speed_rating]', '$_POST[air_pressure_max]', '$_POST[tire_pressure_monitoring_system]', '$_POST[hub_diameter]', '$_POST[weight]', '$_POST[cost_estimate_usd]'";
        $query = "INSERT INTO wheels ($columns) VALUES ($values)";
    } elseif ($operation == "update") {
        $id = $_GET['id'] ?? 0;
        $query = "UPDATE wheels SET 
                    car_model='$_POST[car_model]',
                    brand='$_POST[brand]',
                    type='$_POST[type]',
                    diameter='$_POST[diameter]',
                    width='$_POST[width]',
                    rim_material='$_POST[rim_material]',
                    tire_type='$_POST[tire_type]',
                    tire_brand='$_POST[tire_brand]',
                    tire_size='$_POST[tire_size]',
                    bolt_pattern='$_POST[bolt_pattern]',
                    offset='$_POST[offset]',
                    load_index='$_POST[load_index]',
                    speed_rating='$_POST[speed_rating]',
                    air_pressure_max='$_POST[air_pressure_max]',
                    tire_pressure_monitoring_system='$_POST[tire_pressure_monitoring_system]',
                    hub_diameter='$_POST[hub_diameter]',
                    weight='$_POST[weight]',
                    cost_estimate_usd='$_POST[cost_estimate_usd]'
                  WHERE wheel_id=$id";
    } elseif ($operation == "delete") {
        $id = $_POST['id'];
        $query = "DELETE FROM wheels WHERE wheel_id=$id";
    }

    if (mysqli_query($conn, $query)) {
        echo "<p class='success-msg'>Operation successful!</p>";
    } else {
        echo "<p class='error-msg'>Error: " . mysqli_error($conn) . "</p>";
    }
}
?>


