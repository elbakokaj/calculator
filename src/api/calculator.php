<?php

// calculator.php

include '../../config/db_connect.php';
include '../calculations/calculations.php';
include '../history/HistoryManager.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html");
    exit;
}

$calculator = new Calculations();
$historyManager = new HistoryManager($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $calculator->calculate($_POST['expression']);
    echo $result;
    $historyManager->insertCalculation($_POST['expression'], $result, $_SESSION['user_id']);
} elseif (isset($_GET['action']) && $_GET['action'] == 'getHistory') {
    $history = $historyManager->getCalculationHistory($_SESSION['user_id']);
    header('Content-Type: application/json');
    echo json_encode($history);
    exit;
}

?>

