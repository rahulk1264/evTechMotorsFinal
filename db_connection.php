<?php
// Database connection settings
$servername = "localhost";   // Typically 'localhost' in XAMPP
$username = "root";          // Default username for XAMPP MySQL is 'root'
$password = "";              // Default password for XAMPP MySQL is empty
$dbname = "companydb";    // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// Close the connection
// $conn->close(); // Uncomment this if you want to close the connection immediately
?>
