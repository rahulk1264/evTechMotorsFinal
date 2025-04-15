


<form method="POST" action="" class="crud-form">
<?php if ($_GET['operation'] != 'delete'): ?>
    <label>Car Model:</label>
    <input type="text" name="car_model" required>

    <label>Seat Material:</label>
    <input type="text" name="seat_material" required>

    <label>Seat Color:</label>
    <input type="text" name="seat_color" required>

    <label>Dashboard Material:</label>
    <input type="text" name="dashboard_material" required>

    <label>Dashboard Color:</label>
    <input type="text" name="dashboard_color" required>

    <label>Flooring Material:</label>
    <input type="text" name="flooring_material" required>

    <label>Flooring Color:</label>
    <input type="text" name="flooring_color" required>

    <label>Trim Material:</label>
    <input type="text" name="trim_material" required>

    <label>Trim Color:</label>
    <input type="text" name="trim_color" required>

    <label>Steering Wheel Material:</label>
    <input type="text" name="steering_wheel_material" required>

    <label>Steering Wheel Color:</label>
    <input type="text" name="steering_wheel_color" required>

    <label>Ambient Lighting:</label>
    <select name="ambient_lighting" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>

    <label>Infotainment System:</label>
    <select name="infotainment_system" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>

    <label>Sound System:</label>
    <select name="sound_system" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>

    <label>Seat Adjustment Type:</label>
    <input type="text" name="seat_adjustment_type" required>

    <label>Seat Heating:</label>
    <select name="seat_heating" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>

    <label>Seat Cooling:</label>
    <select name="seat_cooling" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>

    <label>Cup Holder Count:</label>
    <input type="number" name="cup_holder_count" required>

    <label>Sunroof:</label>
    <select name="sunroof" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>

    <label>Climate Control:</label>
    <select name="climate_control" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>
<?php else: ?>
    <label>Interior ID:</label>
    <input type="number" name="id" required>
<?php endif; ?>

    <button type="submit" name="submit">Submit</button>
</form>

<?php
if (isset($_POST['submit'])) {
    $operation = $_GET['operation'];

    if ($operation == "add") {
        $columns = "car_model, seat_material, seat_color, dashboard_material, dashboard_color, flooring_material, flooring_color, trim_material, trim_color, steering_wheel_material, steering_wheel_color, ambient_lighting, infotainment_system, sound_system, seat_adjustment_type, seat_heating, seat_cooling, cup_holder_count, sunroof, climate_control";
        $values = "'$_POST[car_model]', '$_POST[seat_material]', '$_POST[seat_color]', '$_POST[dashboard_material]', '$_POST[dashboard_color]', '$_POST[flooring_material]', '$_POST[flooring_color]', '$_POST[trim_material]', '$_POST[trim_color]', '$_POST[steering_wheel_material]', '$_POST[steering_wheel_color]', '$_POST[ambient_lighting]', '$_POST[infotainment_system]', '$_POST[sound_system]', '$_POST[seat_adjustment_type]', '$_POST[seat_heating]', '$_POST[seat_cooling]', '$_POST[cup_holder_count]', '$_POST[sunroof]', '$_POST[climate_control]'";
        $query = "INSERT INTO car_interior_design ($columns) VALUES ($values)";
    } elseif ($operation == "update") {
        $id = $_GET['id'] ?? 0;
        $query = "UPDATE car_interior_design SET 
                    car_model='$_POST[car_model]',
                    seat_material='$_POST[seat_material]',
                    seat_color='$_POST[seat_color]',
                    dashboard_material='$_POST[dashboard_material]',
                    dashboard_color='$_POST[dashboard_color]',
                    flooring_material='$_POST[flooring_material]',
                    flooring_color='$_POST[flooring_color]',
                    trim_material='$_POST[trim_material]',
                    trim_color='$_POST[trim_color]',
                    steering_wheel_material='$_POST[steering_wheel_material]',
                    steering_wheel_color='$_POST[steering_wheel_color]',
                    ambient_lighting='$_POST[ambient_lighting]',
                    infotainment_system='$_POST[infotainment_system]',
                    sound_system='$_POST[sound_system]',
                    seat_adjustment_type='$_POST[seat_adjustment_type]',
                    seat_heating='$_POST[seat_heating]',
                    seat_cooling='$_POST[seat_cooling]',
                    cup_holder_count='$_POST[cup_holder_count]',
                    sunroof='$_POST[sunroof]',
                    climate_control='$_POST[climate_control]'
                  WHERE interior_id=$id";
    } elseif ($operation == "delete") {
        $id = $_POST['id'];
        $query = "DELETE FROM car_interior_design WHERE interior_id=$id";
    }

    if (mysqli_query($conn, $query)) {
        echo "<p class='success-msg'>Operation successful!</p>";
    } else {
        echo "<p class='error-msg'>Error: " . mysqli_error($conn) . "</p>";
    }
}
?>

