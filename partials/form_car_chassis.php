<form method="POST" action="" class="crud-form">
<?php if ($_GET['operation'] != 'delete'): ?>
    <label>Car Model:</label>
    <input type="text" name="car_model" required>

    <label>Chassis Type:</label>
    <input type="text" name="chassis_type" required>

    <label>Material Used:</label>
    <input type="text" name="material_used" required>

    <label>Frame Structure:</label>
    <input type="text" name="frame_structure" required>

    <label>Weight (kg):</label>
    <input type="number" step="0.1" name="weight_kg" required>

    <label>Length (mm):</label>
    <input type="number" name="length_mm" required>

    <label>Width (mm):</label>
    <input type="number" name="width_mm" required>

    <label>Height (mm):</label>
    <input type="number" name="height_mm" required>

    <label>Wheelbase (mm):</label>
    <input type="number" name="wheelbase_mm" required>

    <label>Front Suspension Type:</label>
    <input type="text" name="front_suspension_type" required>

    <label>Rear Suspension Type:</label>
    <input type="text" name="rear_suspension_type" required>

    <label>Shock Absorber Type:</label>
    <input type="text" name="shock_absorber_type" required>

    <label>Ground Clearance (mm):</label>
    <input type="number" step="0.1" name="ground_clearance_mm" required>

    <label>Number of Doors:</label>
    <input type="number" name="number_of_doors" required>

    <label>Number of Seats:</label>
    <input type="number" name="number_of_seats" required>

    <label>Maximum Payload (kg):</label>
    <input type="number" step="0.1" name="maximum_payload_kg" required>

    <label>Maximum Towing Capacity (kg):</label>
    <input type="number" step="0.1" name="maximum_towing_capacity_kg" required>

    <label>Chassis Color:</label>
    <input type="text" name="chassis_color" required>

    <label>Cost Estimate (USD):</label>
    <input type="number" step="0.01" name="cost_estimate_usd" required>

    <label>Warranty (Years):</label>
    <input type="number" name="warranty_years" required>
<?php else: ?>
    <label>Chassis ID:</label>
    <input type="number" name="id" required>
<?php endif; ?>

    <button type="submit" name="submit">Submit</button>
</form>

<?php
if (isset($_POST['submit'])) {
    $operation = $_GET['operation'];

    if ($operation == "add") {
        $columns = "car_model, chassis_type, material_used, frame_structure, weight_kg, length_mm, width_mm, height_mm, wheelbase_mm, front_suspension_type, rear_suspension_type, shock_absorber_type, ground_clearance_mm, number_of_doors, number_of_seats, maximum_payload_kg, maximum_towing_capacity_kg, chassis_color, cost_estimate_usd, warranty_years";
        $values = "'$_POST[car_model]', '$_POST[chassis_type]', '$_POST[material_used]', '$_POST[frame_structure]', '$_POST[weight_kg]', '$_POST[length_mm]', '$_POST[width_mm]', '$_POST[height_mm]', '$_POST[wheelbase_mm]', '$_POST[front_suspension_type]', '$_POST[rear_suspension_type]', '$_POST[shock_absorber_type]', '$_POST[ground_clearance_mm]', '$_POST[number_of_doors]', '$_POST[number_of_seats]', '$_POST[maximum_payload_kg]', '$_POST[maximum_towing_capacity_kg]', '$_POST[chassis_color]', '$_POST[cost_estimate_usd]', '$_POST[warranty_years]'";
        $query = "INSERT INTO car_chassis ($columns) VALUES ($values)";
    } elseif ($operation == "update") {
        $id = $_GET['id'] ?? 0;
        $query = "UPDATE car_chassis SET 
                    car_model='$_POST[car_model]',
                    chassis_type='$_POST[chassis_type]',
                    material_used='$_POST[material_used]',
                    frame_structure='$_POST[frame_structure]',
                    weight_kg='$_POST[weight_kg]',
                    length_mm='$_POST[length_mm]',
                    width_mm='$_POST[width_mm]',
                    height_mm='$_POST[height_mm]',
                    wheelbase_mm='$_POST[wheelbase_mm]',
                    front_suspension_type='$_POST[front_suspension_type]',
                    rear_suspension_type='$_POST[rear_suspension_type]',
                    shock_absorber_type='$_POST[shock_absorber_type]',
                    ground_clearance_mm='$_POST[ground_clearance_mm]',
                    number_of_doors='$_POST[number_of_doors]',
                    number_of_seats='$_POST[number_of_seats]',
                    maximum_payload_kg='$_POST[maximum_payload_kg]',
                    maximum_towing_capacity_kg='$_POST[maximum_towing_capacity_kg]',
                    chassis_color='$_POST[chassis_color]',
                    cost_estimate_usd='$_POST[cost_estimate_usd]',
                    warranty_years='$_POST[warranty_years]'
                  WHERE chassis_id=$id";
    } elseif ($operation == "delete") {
        $id = $_POST['id'];
        $query = "DELETE FROM car_chassis WHERE chassis_id=$id";
    }

    if (mysqli_query($conn, $query)) {
        echo "<p class='success-msg'>Operation successful!</p>";
    } else {
        echo "<p class='error-msg'>Error: " . mysqli_error($conn) . "</p>";
    }
}
?>
