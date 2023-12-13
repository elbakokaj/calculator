<?php

include 'db_connect.php';

class Calculator {
    public function calculate($expression) {
        $expression = preg_replace('/[^0-9+\-.*\/\(\) ]/', '', $expression);

        try {
            @eval("\$result = $expression;");
            return $result;
        } catch (Exception $e) {
            return "Error: Invalid Expression";
        }
    }

    public function insertCalculation($expression, $result) {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO calculation_history (expression, result) VALUES (?, ?)");
        $stmt->bind_param("ss", $expression, $result);
        $stmt->execute();
        $stmt->close();
    }

    public function getCalculationHistory() {
        global $conn;
        $sql = "SELECT * FROM calculation_history ORDER BY calculated_at DESC";
        $result = $conn->query($sql);
    
        $history = [];
        while ($row = $result->fetch_assoc()) {
            $history[] = $row;
        }
    
        header('Content-Type: application/json');
        return json_encode($history);
    }
    
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $calculator = new Calculator();
    $result = $calculator->calculate($_POST['expression']);
    echo $result;

   
    $calculator->insertCalculation($_POST['expression'], $result);
} elseif (isset($_GET['action']) && $_GET['action'] == 'getHistory') {
    $calculator = new Calculator();
    echo $calculator->getCalculationHistory();
    exit;
}