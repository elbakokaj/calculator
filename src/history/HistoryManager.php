
<?php
class HistoryManager {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function insertCalculation($expression, $result, $userId) {
        $stmt = $this->conn->prepare("INSERT INTO calculation_history (expression, result, user_id) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $expression, $result, $userId);
        $stmt->execute();
        $stmt->close();
    }

    public function getCalculationHistory($userId) {
        $stmt = $this->conn->prepare("SELECT * FROM calculation_history WHERE user_id = ? ORDER BY calculated_at DESC");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $history = [];
        while ($row = $result->fetch_assoc()) {
            $history[] = $row;
        }
    
        $stmt->close();
        return $history;
    }
}
?>