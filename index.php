
<?php 
include './src/sessions/SessionManager.php';
session_start();

$sessionManager = new SessionManager();
$sessionManager->redirectToAppropriatePage();
?>

