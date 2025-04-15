<?php
include '../db_connection.php';
session_start();


if (!isset($_SESSION['userid']) || empty($_SESSION['cart'])) {
    header('Location: ../user_dashboard.php');
    exit();
}

$user_id = $_SESSION['userid'];
$cart = $_SESSION['cart'];


$battery_id = isset($cart['battery'][0]) ? $cart['battery'][0] : null;
$ac_system_id = isset($cart['car_ac_systems'][0]) ? $cart['car_ac_systems'][0] : null;
$chassis_id = isset($cart['car_chassis'][0]) ? $cart['car_chassis'][0] : null;
$display_id = isset($cart['car_display_systems'][0]) ? $cart['car_display_systems'][0] : null;
$interior_id = isset($cart['car_interior_design'][0]) ? $cart['car_interior_design'][0] : null;
$paint_id = isset($cart['car_paint'][0]) ? $cart['car_paint'][0] : null;
$music_system_id = isset($cart['music_system'][0]) ? $cart['music_system'][0] : null;
$wheel_id = isset($cart['wheels'][0]) ? $cart['wheels'][0] : null;


$order_query = "INSERT INTO orders (user_id, battery_id, ac_system_id, chassis_id, display_id, interior_id, paint_id, music_system_id, wheel_id)
                VALUES ($user_id, $battery_id, $ac_system_id, $chassis_id, $display_id, $interior_id, $paint_id, $music_system_id, $wheel_id)";

if ($conn->query($order_query)) {
    
    $order_id = $conn->insert_id;

    
    echo "<div style='background-color: #28a745; color: white; padding: 15px; font-size: 18px; text-align: center; border-radius: 5px; margin-bottom: 20px;'>
        Order placed successfully! Order ID: <strong>$order_id</strong>
      </div>";

   
    unset($_SESSION['cart']);

    
   
    exit();
} else {
   
    echo "Error placing order: " . $conn->error . "<br>";
}
?>
