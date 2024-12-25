<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "rohan";
$dbname = "restaurant";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get POST data
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['cart']) && isset($data['billAmount']) && isset($data['cashGiven']) && isset($data['change'])) {
    $cart = json_encode($data['cart']); // Convert cart array to JSON
    $billAmount = $data['billAmount'];
    $cashGiven = $data['cashGiven'];
    $change = $data['change'];

    // Prepare SQL statement
    $stmt = $conn->prepare("INSERT INTO payments (cart, bill_amount, cash_given, change_returned) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sddd", $cart, $billAmount, $cashGiven, $change);

    if ($stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Payment saved successfully"]);
    } else {
        echo json_encode(["success" => false, "message" => "Error saving payment"]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Invalid data"]);
}

$conn->close();
?>