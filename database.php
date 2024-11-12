<?php
// Database connection
$host = 'localhost';
$db = 'sonie';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$full_name = $_POST['full_name'];
$phone_number = $_POST['phone_number'];
$food_drinks = $_POST['food_drinks'];
$email_address = $_POST['email_address'];
$num_guests = $_POST['num_guests'];
$payment_info = $_POST['payment_info'];
$date_time = $_POST['date_time'];
$special_request = $_POST['special_request'];
$contact_method = $_POST['contact_method'];
$dietary_restrictions = isset($_POST['dietary_restrictions']) ? 1 : 0;
// Retrieve other checkbox values similarly...

// SQL Insert Query
$sql = "INSERT INTO reservations (full_name, phone_number, food_drinks, email_address, num_guests, payment_info, date_time, special_request, contact_method, dietary_restrictions)
VALUES ('$full_name', '$phone_number', '$food_drinks', '$email_address', '$num_guests', '$payment_info', '$date_time', '$special_request', '$contact_method', '$dietary_restrictions')";

// Execute the query
if ($conn->query($sql) === TRUE) {
    echo "Reservation submitted successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
