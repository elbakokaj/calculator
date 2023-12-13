<?php
include 'db_connect.php'; // Include your DB connection script

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();

    if ($stmt->affected_rows === 1) {
        header("Location: login.html"); // Redirect to login page after successful registration
        exit;
    } else {
        echo "Registration failed";
    }

    $stmt->close();
    $conn->close();
}



?>
