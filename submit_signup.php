<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $age = $_POST['age'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $address = $_POST['address'];

    // Database connection
    $conn = new mysqli("localhost", "root", "rohan", "restaurant");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, mobile, age, password, address) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssiss", $firstName, $lastName, $email, $mobile, $age, $password, $address);

    if ($stmt->execute()) {
        echo "<script>alert('Signup successful!'); window.location.href='WebForm2.html';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>