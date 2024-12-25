<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and validate POST data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $people = intval($_POST['people']);
    $time = trim($_POST['time']);
    $date = trim($_POST['date']);
    $phone = trim($_POST['phone']);

    if (empty($name) || empty($email) || empty($people) || empty($time) || empty($date) || empty($phone)) {
        die("All fields are required.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    // Database connection
    $conn = new mysqli("localhost", "root", "rohan", "restaurant");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO bookings (name, email, people, time, date, phone) VALUES (?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Error in statement preparation: " . $conn->error);
    }
    $stmt->bind_param("ssisss", $name, $email, $people, $time, $date, $phone);

    // Execute SQL statement
    if ($stmt->execute()) {
        echo "Booking successful!";
    } else {
        echo "Error:" . $stmt->error;
    }

    // Close connections
    $stmt->close();
    $conn->close();
}
?>