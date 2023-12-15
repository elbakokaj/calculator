<?php
session_start();
include '../../config/db_connect.php';

$response = ['success' => false, 'message' => ''];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $username;
            $response['success'] = true;
            $response['message'] = 'Login successful';
        } else {
            $response['message'] = 'Invalid username or password';
        }
    } else {
        $response['message'] = 'Invalid username or password';
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);

    // echo "Invalid username or password";
    $stmt->close();
    $conn->close();
}

?>
