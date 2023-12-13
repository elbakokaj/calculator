<?php

class Calculator {
    public function calculate($expression) {
        $expression = preg_replace('/[^0-9+\-.*\/]/', '', $expression);

        $numbers = preg_split('/[+\-*\/]/', $expression);
        $operators = str_split(preg_replace('/[0-9]+/', '', $expression));

        $result = floatval($numbers[0]);
        for ($i = 0; $i < count($operators); $i++) {
            $nextNumber = floatval($numbers[$i + 1]);
            switch ($operators[$i]) {
                case '+':
                    $result += $nextNumber;
                    break;
                case '-':
                    $result -= $nextNumber;
                    break;
                case '*':
                    $result *= $nextNumber;
                    break;
                case '/':
                    if ($nextNumber == 0) {
                        return "Error: Division by Zero";
                    }
                    $result /= $nextNumber;
                    break;
            }
        }

        return $result;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $calculator = new Calculator();
    echo $calculator->calculate($_POST['expression']);
}
?>

