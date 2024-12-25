<?php
// Start the session
session_start();

// Connect to the database
$conn = new mysqli("localhost", "root", "rohan", "restaurant");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    // Check if the user exists in the database
    $sql = "SELECT * FROM users WHERE mobile = '$mobile' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login successful
        $_SESSION['mobile'] = $mobile;
        echo "<script>alert('Login Successful!'); window.location.href = 'dashboard.php';</script>";
    } else {
        // Login failed
        echo "<script>alert('Invalid mobile number or password'); window.location.href = 'index.html';</script>";
    }
}

$conn->close();
?>