<form method="POST" action="" class="crud-form">
<?php if ($_GET['operation'] != 'delete'): ?>
    <label>Car Model:</label>
    <input type="text" name="car_model" required>

    <label>AC Type:</label>
    <input type="text" name="ac_type" required>

    <label>Refrigerant Type:</label>
    <input type="text" name="refrigerant_type" required>

    <label>AC Capacity (in tons or appropriate unit):</label>
    <input type="number" name="ac_capacity" required>

    <label>Cooling Capacity:</label>
    <input type="number" name="cooling_capacity" required>

    <label>Heating Capacity:</label>
    <input type="number" name="heating_capacity" required>

    <label>Compressor Brand:</label>
    <input type="text" name="compressor_brand" required>

    <label>Compressor Type:</label>
    <input type="text" name="compressor_type" required>

    <label>Air Filter Type:</label>
    <input type="text" name="air_filter_type" required>

    <label>Cabin Air Filter:</label>
    <select name="cabin_air_filter" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>

    <label>Climate Control:</label>
    <select name="climate_control" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>

    <label>Ventilation System:</label>
    <input type="text" name="ventilation_system" required>

    <label>Multi-Zone Climate:</label>
    <select name="multi_zone_climate" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>

    <label>Air Quality Control:</label>
    <select name="air_quality_control" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>

    <label>AC Efficiency Rating:</label>
    <input type="text" name="ac_efficiency_rating" required>

    <label>Cost Estimate (USD):</label>
    <input type="number" step="0.01" name="cost_estimate_usd" required>

    <label>Warranty (Years):</label>
    <input type="number" name="warranty_years" required>
<?php else: ?>
    <label>AC ID:</label>
    <input type="number" name="id" required>
<?php endif; ?>

    <button type="submit" name="submit">Submit</button>
</form>

<?php
if (isset($_POST['submit'])) {
    $operation = $_GET['operation'];

    if ($operation == "add") {
        $columns = "car_model, ac_type, refrigerant_type, ac_capacity, cooling_capacity, heating_capacity, compressor_brand, compressor_type, air_filter_type, cabin_air_filter, climate_control, ventilation_system, multi_zone_climate, air_quality_control, ac_efficiency_rating, cost_estimate_usd, warranty_years";
        $values = "'$_POST[car_model]', '$_POST[ac_type]', '$_POST[refrigerant_type]', '$_POST[ac_capacity]', '$_POST[cooling_capacity]', '$_POST[heating_capacity]', '$_POST[compressor_brand]', '$_POST[compressor_type]', '$_POST[air_filter_type]', '$_POST[cabin_air_filter]', '$_POST[climate_control]', '$_POST[ventilation_system]', '$_POST[multi_zone_climate]', '$_POST[air_quality_control]', '$_POST[ac_efficiency_rating]', '$_POST[cost_estimate_usd]', '$_POST[warranty_years]'";
        $query = "INSERT INTO car_ac_systems ($columns) VALUES ($values)";
    } elseif ($operation == "update") {
        $id = $_GET['id'] ?? 0;
        $query = "UPDATE car_ac_systems SET 
                    car_model='$_POST[car_model]',
                    ac_type='$_POST[ac_type]',
                    refrigerant_type='$_POST[refrigerant_type]',
                    ac_capacity='$_POST[ac_capacity]',
                    cooling_capacity='$_POST[cooling_capacity]',
                    heating_capacity='$_POST[heating_capacity]',
                    compressor_brand='$_POST[compressor_brand]',
                    compressor_type='$_POST[compressor_type]',
                    air_filter_type='$_POST[air_filter_type]',
                    cabin_air_filter='$_POST[cabin_air_filter]',
                    climate_control='$_POST[climate_control]',
                    ventilation_system='$_POST[ventilation_system]',
                    multi_zone_climate='$_POST[multi_zone_climate]',
                    air_quality_control='$_POST[air_quality_control]',
                    ac_efficiency_rating='$_POST[ac_efficiency_rating]',
                    cost_estimate_usd='$_POST[cost_estimate_usd]',
                    warranty_years='$_POST[warranty_years]'
                  WHERE ac_id=$id";
    } elseif ($operation == "delete") {
        $id = $_POST['id'];
        $query = "DELETE FROM car_ac_systems WHERE ac_id=$id";
    }

    if (mysqli_query($conn, $query)) {
        echo "<p class='success-msg'>Operation successful!</p>";
    } else {
        echo "<p class='error-msg'>Error: " . mysqli_error($conn) . "</p>";
    }
}
?>
