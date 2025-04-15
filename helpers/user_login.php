<?php
session_start();
$host = 'localhost'; // Change to your database host
$username = 'root';  // Change to your database username
$password = '';      // Change to your database password
$dbname = 'companydb'; // Change to your database name

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle login request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sanitize user inputs
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Query to check if the user exists
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verify password
        if ($password == $user['password']) {
            // Set session variables
            $_SESSION['userid'] = $user['userid'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            
            // Redirect to the dashboard
            header("Location: ../user_dashboard.php");
            exit();
        } else {
            $error_message = "Invalid password!";
        }
    } else {
        $error_message = "No user found with that email!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .login-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        .form-group input:focus {
            border-color: #007bff;
        }
        .btn {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
        .success {
            color: green;
            text-align: center;
            margin-bottom: 15px;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>User Login</h2>

    <?php if (isset($error_message)): ?>
        <div class="error"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <form action="user_login.php" method="POST">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>

        <button type="submit" class="btn">Login</button>
    </form>

    <p class="text-center">Don't have an account? <a href="register.php">Register here</a></p>
</div>

<script>
    // JavaScript to ensure the form fields are validated before submission
    document.querySelector('form').addEventListener('submit', function(event) {
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;

        if (email == "" || password == "") {
            event.preventDefault();
            alert("Both fields are required.");
        }
    });
</script>

</body>
</html>

<?php
$conn->close();
?>
