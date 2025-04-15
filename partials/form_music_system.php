<form method="POST" action="" class="crud-form">
<?php if ($_GET['operation'] != 'delete'): ?>
    <label>Brand:</label>
    <input type="text" name="brand" required>

    <label>Model Name:</label>
    <input type="text" name="model_name" required>

    <label>Speaker Count:</label>
    <input type="number" name="speaker_count" required>

    <label>Tweeters:</label>
    <input type="number" name="tweeters" required>

    <label>Subwoofer:</label>
    <select name="subwoofer" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>

    <label>Amplifier Power (Watts):</label>
    <input type="number" name="amplifier_power_watts" required>

    <label>Total Output Power (Watts):</label>
    <input type="number" name="total_output_power_watts" required>

    <label>Audio Format Support:</label>
    <input type="text" name="audio_format_support" required>

    <label>Connectivity Options:</label>
    <input type="text" name="connectivity_options" required>

    <label>Touchscreen Display Size (inches):</label>
    <input type="number" step="0.1" name="touchscreen_display_size" required>

    <label>Equalizer Options:</label>
    <input type="text" name="equalizer_options" required>

    <label>Noise Cancellation:</label>
    <select name="noise_cancellation" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>

    <label>Voice Control:</label>
    <select name="voice_control" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>

    <label>Compatibility:</label>
    <input type="text" name="compatibility" required>

    <label>OTA Updates:</label>
    <select name="ota_updates" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>

    <label>UI Customizable:</label>
    <select name="ui_customizable" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>

    <label>Sound Modes:</label>
    <input type="text" name="sound_modes" required>

    <label>3D Sound Support:</label>
    <select name="3d_sound_support" required>
        <option value="1">Yes</option>
        <option value="0">No</option>
    </select>

    <label>Placement Notes:</label>
    <input type="text" name="placement_notes" required>

    <label>Cost Estimate (USD):</label>
    <input type="number" step="0.01" name="cost_estimate_usd" required>
<?php else: ?>
    <label>System ID:</label>
    <input type="number" name="id" required>
<?php endif; ?>

    <button type="submit" name="submit">Submit</button>
</form>

<?php
if (isset($_POST['submit'])) {
    $operation = $_GET['operation'];

    // Sanitize and escape input to avoid SQL injection
    $brand = mysqli_real_escape_string($conn, $_POST['brand']);
    $model_name = mysqli_real_escape_string($conn, $_POST['model_name']);
    $speaker_count = (int)$_POST['speaker_count']; // Cast to integer
    $tweeters = (int)$_POST['tweeters']; // Cast to integer
    $subwoofer = (int)$_POST['subwoofer']; // Cast to integer
    $amplifier_power_watts = (float)$_POST['amplifier_power_watts']; // Cast to float
    $total_output_power_watts = (float)$_POST['total_output_power_watts']; // Cast to float
    $audio_format_support = mysqli_real_escape_string($conn, $_POST['audio_format_support']);
    $connectivity_options = mysqli_real_escape_string($conn, $_POST['connectivity_options']);
    $touchscreen_display_size = (float)$_POST['touchscreen_display_size']; // Cast to float
    $equalizer_options = mysqli_real_escape_string($conn, $_POST['equalizer_options']);
    $noise_cancellation = (int)$_POST['noise_cancellation']; // Cast to integer
    $voice_control = (int)$_POST['voice_control']; // Cast to integer
    $compatibility = mysqli_real_escape_string($conn, $_POST['compatibility']);
    $ota_updates = (int)$_POST['ota_updates']; // Cast to integer
    $ui_customizable = (int)$_POST['ui_customizable']; // Cast to integer
    $sound_modes = mysqli_real_escape_string($conn, $_POST['sound_modes']);
    $three_d_sound_support = (int)$_POST['3d_sound_support']; // Cast to integer
    $placement_notes = mysqli_real_escape_string($conn, $_POST['placement_notes']);
    $cost_estimate_usd = (float)$_POST['cost_estimate_usd']; // Cast to float

    if ($operation == "add") {
        $columns = "brand, model_name, speaker_count, tweeters, subwoofer, amplifier_power_watts, total_output_power_watts, audio_format_support, connectivity_options, touchscreen_display_size, equalizer_options, noise_cancellation, voice_control, compatibility, ota_updates, ui_customizable, sound_modes, 3d_sound_support, placement_notes, cost_estimate_usd";
        $values = "'$brand', '$model_name', $speaker_count, $tweeters, $subwoofer, $amplifier_power_watts, $total_output_power_watts, '$audio_format_support', '$connectivity_options', $touchscreen_display_size, '$equalizer_options', $noise_cancellation, $voice_control, '$compatibility', $ota_updates, $ui_customizable, '$sound_modes', $three_d_sound_support, '$placement_notes', $cost_estimate_usd";
        $query = "INSERT INTO music_system ($columns) VALUES ($values)";
    } elseif ($operation == "update") {
        $id = $_GET['id'] ?? 0;
        $query = "UPDATE music_system SET 
                    brand='$brand',
                    model_name='$model_name',
                    speaker_count=$speaker_count,
                    tweeters=$tweeters,
                    subwoofer=$subwoofer,
                    amplifier_power_watts=$amplifier_power_watts,
                    total_output_power_watts=$total_output_power_watts,
                    audio_format_support='$audio_format_support',
                    connectivity_options='$connectivity_options',
                    touchscreen_display_size=$touchscreen_display_size,
                    equalizer_options='$equalizer_options',
                    noise_cancellation=$noise_cancellation,
                    voice_control=$voice_control,
                    compatibility='$compatibility',
                    ota_updates=$ota_updates,
                    ui_customizable=$ui_customizable,
                    sound_modes='$sound_modes',
                    3d_sound_support=$three_d_sound_support,
                    placement_notes='$placement_notes',
                    cost_estimate_usd=$cost_estimate_usd
                  WHERE system_id=$id";
    } elseif ($operation == "delete") {
        $id = $_POST['id'];
        $query = "DELETE FROM music_system WHERE system_id=$id";
    }

    if (mysqli_query($conn, $query)) {
        echo "<p class='success-msg'>Operation successful!</p>";
    } else {
        echo "<p class='error-msg'>Error: " . mysqli_error($conn) . "</p>";
    }
}
?>
