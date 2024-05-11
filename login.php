<?php
include 'config.php';
$conn = new mysqli($servername, $username, $password, $dbname);


$username = $_POST['username'];
$password = $_POST['password'];

$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);

$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        session_start();
        $_SESSION['username'] = $username;
        echo "Login successful";
    } else {
        echo "Invalid password";
    }
} else {
    echo "User not found";
}

$conn->close();
?>
