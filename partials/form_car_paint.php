<form method="POST" action="" class="crud-form">
<?php if ($_GET['operation'] != 'delete'): ?>
    <label>Car Model:</label>
    <input type="text" name="car_model" required>

    <label>Paint Color:</label>
    <input type="text" name="paint_color" required>

    <label>Color Code:</label>
    <input type="text" name="color_code" required>

    <label>Paint Type:</label>
    <input type="text" name="paint_type" required>

    <label>Finish Type:</label>
    <input type="text" name="finish_type" required>

    <label>Brand:</label>
    <input type="text" name="brand" required>

    <label>Metallic:</label>
    <select name="is_metallic" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>

    <label>Perlescent:</label>
    <select name="is_perlescent" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>

    <label>Cost Estimate (USD):</label>
    <input type="number" step="0.01" name="cost_estimate_usd" required>

    <label>Warranty (Years):</label>
    <input type="number" name="warranty_years" required>

    <label>Durability Rating:</label>
    <input type="text" name="durability_rating" required>

    <label>Weather Resistance:</label>
    <select name="weather_resistance" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>

    <label>UV Protection:</label>
    <select name="UV_protection" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>
<?php else: ?>
    <label>Paint ID:</label>
    <input type="number" name="id" required>
<?php endif; ?>

    <button type="submit" name="submit">Submit</button>
</form>

<?php
if (isset($_POST['submit'])) {
    $operation = $_GET['operation'];

    if ($operation == "add") {
        $columns = "car_model, paint_color, color_code, paint_type, finish_type, brand, is_metallic, is_perlescent, cost_estimate_usd, warranty_years, durability_rating, weather_resistance, UV_protection";
        $values = "'$_POST[car_model]', '$_POST[paint_color]', '$_POST[color_code]', '$_POST[paint_type]', '$_POST[finish_type]', '$_POST[brand]', '$_POST[is_metallic]', '$_POST[is_perlescent]', '$_POST[cost_estimate_usd]', '$_POST[warranty_years]', '$_POST[durability_rating]', '$_POST[weather_resistance]', '$_POST[UV_protection]'";
        $query = "INSERT INTO car_paint ($columns) VALUES ($values)";
    } elseif ($operation == "update") {
        $id = $_GET['id'] ?? 0;
        $query = "UPDATE car_paint SET 
                    car_model='$_POST[car_model]',
                    paint_color='$_POST[paint_color]',
                    color_code='$_POST[color_code]',
                    paint_type='$_POST[paint_type]',
                    finish_type='$_POST[finish_type]',
                    brand='$_POST[brand]',
                    is_metallic='$_POST[is_metallic]',
                    is_perlescent='$_POST[is_perlescent]',
                    cost_estimate_usd='$_POST[cost_estimate_usd]',
                    warranty_years='$_POST[warranty_years]',
                    durability_rating='$_POST[durability_rating]',
                    weather_resistance='$_POST[weather_resistance]',
                    UV_protection='$_POST[UV_protection]'
                  WHERE paint_id=$id";
    } elseif ($operation == "delete") {
        $id = $_POST['id'];
        $query = "DELETE FROM car_paint WHERE paint_id=$id";
    }

    if (mysqli_query($conn, $query)) {
        echo "<p class='success-msg'>Operation successful!</p>";
    } else {
        echo "<p class='error-msg'>Error: " . mysqli_error($conn) . "</p>";
    }
}
?>
