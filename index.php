
<?php 
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: calculator.php"); // Redirect to calculator if logged in
    exit;
} else {
    header("Location: login.html"); // Redirect to login page if not logged in
    exit;
}
?>

