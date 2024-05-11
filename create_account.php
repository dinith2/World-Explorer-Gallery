<?php
include 'config.php';
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$password = $_POST['password'];
$address = $_POST['address'];
$phone = $_POST['phone'];

$firstname = mysqli_real_escape_string($conn, $firstname);
$lastname = mysqli_real_escape_string($conn, $lastname);
$password = mysqli_real_escape_string($conn, $password);
$address = mysqli_real_escape_string($conn, $address);
$phone = mysqli_real_escape_string($conn, $phone);

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (firstname, lastname, password, address, phone) 
        VALUES ('$firstname', '$lastname', '$hashed_password', '$address', '$phone')";

if ($conn->query($sql) === TRUE) {
    echo "Account created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
