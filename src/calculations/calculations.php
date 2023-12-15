<?php

class Calculations {
    public function calculate($expression) {
        $expression = preg_replace('/[^0-9+\-.*\/\(\) ]/', '', $expression);

        try {
            @eval("\$result = $expression;");
            return $result;
        } catch (Exception $e) {
            return "Error: Invalid Expression";
        }
    }
}

?>