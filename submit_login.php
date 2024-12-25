<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    // Database connection
    $conn = new mysqli("localhost", "root", "rohan", "restaurant");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepared statement to check if the user exists
    $stmt = $conn->prepare("SELECT password FROM users WHERE mobile = ?");
    $stmt->bind_param("s", $mobile);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Redirect to the main project page on successful login
            echo "<script>alert('Login successful! Redirecting to the main page.'); window.location.href='project.html';</script>";
        } else {
            echo "<script>alert('Incorrect password. Please try again.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Mobile number not found. Please register first.'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>