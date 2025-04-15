

<form method="POST" action="" class="crud-form">
    <?php if ($_GET['operation'] != 'delete'): ?>
        <label>Manufacturer:</label>
        <input type="text" name="manufacturer" required>

        <label>Model Name:</label>
        <input type="text" name="model_name" required>

        <label>Chemistry:</label>
        <input type="text" name="chemistry" required>

        <label>Capacity (kWh):</label>
        <input type="number" step="0.1" name="capacity_kWh" required>

        <label>Usable Capacity (kWh):</label>
        <input type="number" step="0.1" name="usable_capacity_kWh" required>

        <label>Voltage:</label>
        <input type="number" step="0.1" name="voltage" required>

        <label>Modules:</label>
        <input type="number" name="modules" required>

        <label>Cells:</label>
        <input type="number" name="cells" required>

        <label>Cell Type:</label>
        <input type="text" name="cell_type" required>

        <label>Max Charging Power (kW):</label>
        <input type="number" step="0.1" name="max_charging_power_kW" required>

        <label>Max Discharging Power (kW):</label>
        <input type="number" step="0.1" name="max_discharging_power_kW" required>

        <label>Charging Time (10-80% in minutes):</label>
        <input type="number" name="charging_time_10_80_min" required>

        <label>Range (km):</label>
        <input type="number" name="range_km" required>

        <label>Efficiency (km/kWh):</label>
        <input type="number" step="0.01" name="efficiency_km_per_kWh" required>

        <label>Degradation per 10,000 km:</label>
        <input type="number" step="0.01" name="degradation_per_10000km" required>

        <label>Cycles before 80%:</label>
        <input type="number" name="cycles_before_80_percent" required>

        <label>Battery Management System:</label>
        <input type="text" name="battery_management_system" required>

        <label>Thermal Management:</label>
        <input type="text" name="thermal_management" required>

        <label>Active Cooling:</label>
        <input type="text" name="active_cooling" required>

        <label>Passive Cooling:</label>
        <input type="text" name="passive_cooling" required>

        <label>Fast Charging Support:</label>
        <input type="text" name="fast_charging_support" required>

        <label>Wireless Charging Support:</label>
        <input type="text" name="wireless_charging_support" required>

        <label>Swappable:</label>
        <input type="text" name="swappable" required>

        <label>Placement:</label>
        <input type="text" name="placement" required>

        <label>Waterproof Rating:</label>
        <input type="text" name="waterproof_rating" required>

        <label>Fire Protection:</label>
        <input type="text" name="fire_protection" required>

        <label>Safety Certifications:</label>
        <input type="text" name="safety_certifications" required>

        <label>Smart BMS:</label>
        <input type="text" name="smart_bms" required>

        <label>Remote Monitoring:</label>
        <input type="text" name="remote_monitoring" required>

        <label>Temperature Range:</label>
        <input type="text" name="temperature_range" required>

        <label>Cost Estimate (USD):</label>
        <input type="number" step="0.01" name="cost_estimate_usd" required>
    <?php else: ?>
        <label>Battery ID:</label>
        <input type="number" name="id" required>
    <?php endif; ?>

    <button type="submit" name="submit">Submit</button>
</form>

<?php
if (isset($_POST['submit'])) {
    $operation = $_GET['operation'];

    if ($operation == "add") {
        $columns = "manufacturer, model_name, chemistry, capacity_kWh, usable_capacity_kWh, voltage, modules, cells, cell_type, max_charging_power_kW, max_discharging_power_kW, charging_time_10_80_min, range_km, efficiency_km_per_kWh, degradation_per_10000km, cycles_before_80_percent, battery_management_system, thermal_management, active_cooling, passive_cooling, fast_charging_support, wireless_charging_support, swappable, placement, waterproof_rating, fire_protection, safety_certifications, smart_bms, remote_monitoring, temperature_range, cost_estimate_usd";
        $values = "'$_POST[manufacturer]', '$_POST[model_name]', '$_POST[chemistry]', '$_POST[capacity_kWh]', '$_POST[usable_capacity_kWh]', '$_POST[voltage]', '$_POST[modules]', '$_POST[cells]', '$_POST[cell_type]', '$_POST[max_charging_power_kW]', '$_POST[max_discharging_power_kW]', '$_POST[charging_time_10_80_min]', '$_POST[range_km]', '$_POST[efficiency_km_per_kWh]', '$_POST[degradation_per_10000km]', '$_POST[cycles_before_80_percent]', '$_POST[battery_management_system]', '$_POST[thermal_management]', '$_POST[active_cooling]', '$_POST[passive_cooling]', '$_POST[fast_charging_support]', '$_POST[wireless_charging_support]', '$_POST[swappable]', '$_POST[placement]', '$_POST[waterproof_rating]', '$_POST[fire_protection]', '$_POST[safety_certifications]', '$_POST[smart_bms]', '$_POST[remote_monitoring]', '$_POST[temperature_range]', '$_POST[cost_estimate_usd]'";
        $query = "INSERT INTO battery ($columns) VALUES ($values)";
    } elseif ($operation == "update") {
        $id = $_GET['id'] ?? 0;
        $query = "UPDATE battery SET 
                    manufacturer='$_POST[manufacturer]',
                    model_name='$_POST[model_name]',
                    chemistry='$_POST[chemistry]',
                    capacity_kWh='$_POST[capacity_kWh]',
                    usable_capacity_kWh='$_POST[usable_capacity_kWh]',
                    voltage='$_POST[voltage]',
                    modules='$_POST[modules]',
                    cells='$_POST[cells]',
                    cell_type='$_POST[cell_type]',
                    max_charging_power_kW='$_POST[max_charging_power_kW]',
                    max_discharging_power_kW='$_POST[max_discharging_power_kW]',
                    charging_time_10_80_min='$_POST[charging_time_10_80_min]',
                    range_km='$_POST[range_km]',
                    efficiency_km_per_kWh='$_POST[efficiency_km_per_kWh]',
                    degradation_per_10000km='$_POST[degradation_per_10000km]',
                    cycles_before_80_percent='$_POST[cycles_before_80_percent]',
                    battery_management_system='$_POST[battery_management_system]',
                    thermal_management='$_POST[thermal_management]',
                    active_cooling='$_POST[active_cooling]',
                    passive_cooling='$_POST[passive_cooling]',
                    fast_charging_support='$_POST[fast_charging_support]',
                    wireless_charging_support='$_POST[wireless_charging_support]',
                    swappable='$_POST[swappable]',
                    placement='$_POST[placement]',
                    waterproof_rating='$_POST[waterproof_rating]',
                    fire_protection='$_POST[fire_protection]',
                    safety_certifications='$_POST[safety_certifications]',
                    smart_bms='$_POST[smart_bms]',
                    remote_monitoring='$_POST[remote_monitoring]',
                    temperature_range='$_POST[temperature_range]',
                    cost_estimate_usd='$_POST[cost_estimate_usd]'
                  WHERE id=$id";
    } elseif ($operation == "delete") {
        $id = $_POST['id'];
        $query = "DELETE FROM battery WHERE battery_id=$id";
    }

    if (mysqli_query($conn, $query)) {
        echo "<p class='success-msg'>Operation successful!</p>";
    } else {
        echo "<p class='error-msg'>Error: " . mysqli_error($conn) . "</p>";
    }
}
?>


