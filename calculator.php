<?php

include 'db_connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html"); // Redirect to login page if not logged in
    exit;
}

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

    public function insertCalculation($expression, $result, $userId) {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO calculation_history (expression, result, user_id) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $expression, $result, $userId);
        $stmt->execute();
        $stmt->close();
    }

    public function getCalculationHistory($userId) {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM calculation_history WHERE user_id = ? ORDER BY calculated_at DESC");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $history = [];
        while ($row = $result->fetch_assoc()) {
            $history[] = $row;
        }
    
        $stmt->close();
        header('Content-Type: application/json');
        return json_encode($history);
    }
    
    
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $calculator = new Calculator();
    $result = $calculator->calculate($_POST['expression']);
    echo $result;

   
    $calculator->insertCalculation($_POST['expression'], $result, $_SESSION['user_id']);} elseif (isset($_GET['action']) && $_GET['action'] == 'getHistory') {
    $calculator = new Calculator();
    echo $calculator->getCalculationHistory($_SESSION['user_id']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
    <style>
        body {
            background-color: rgb(163, 159, 159);
        }

        .calc {

            margin: auto;
            background-color: black;
            border: 2px solid whitesmoke;
            width: 24%;
            height: 630px;
            border-radius: 20px;
            box-shadow: 10px 10px 40px;
        }

        .maininput {
            background-color: black;
            border: 1px solid grey;
            height: 125px;
            width: 98.2%;
            font-size: 80px;
            color: whitesmoke;
            font-weight: 00;
        }

        .numbtn {
            padding: 30px 35px;
            border-radius: 50px;
            font-weight: 500;
            font-size: large;
            background-color: rgb(155, 154, 154);
        }

        .numbtn:hover {
            background-color: rgb(136, 133, 133);
            color: whitesmoke;
        }

        .calbtn {
            padding: 30px 35px;
            border-radius: 50px;
            font-weight: 500;
            font-size: 30px;
            background-color: orange;
        }

        .calbtn:hover {
            background-color: rgb(211, 140, 7);
            color: whitesmoke;
        }
 

        .c {
            padding: 30px 35px;
            border-radius: 50px;
            font-weight: 500;
            font-size: large;
            background-color: red;
        }

        .c:hover {
            background-color: rgb(188, 16, 16);
            color: whitesmoke;
        }

        .equal {
            padding: 30px 35px;
            border-radius: 50px;
            font-weight: 500;
            font-size: large;
            background-color: rgb(8, 181, 8);
        }

        .equal:hover {
            background-color: green;
            color: whitesmoke;
        }
        .bracketbtn {
            padding: 30px 35px;
            border-radius: 50px;
            font-weight: 500;
            font-size: large;
            background-color: yellow;
            
        }

        .bracketbtn:hover {
            background-color: yellow;
            color: whitesmoke;
        }
    </style>
</head>

<body>
    <div class="calc">
        <form action="" method="post">
            <br>
            <input type="text" class="maininput" name="input" value=""> <br> <br>
            <input type="button" class="numbtn" name="num" value="7">
            <input type="button" class="numbtn" name="num" value="8">
            <input type="button" class="numbtn" name="num" value="9">
            <input type="button" class="calbtn" name="op" value="+"> <br><br>
            <input type="button" class="numbtn" name="num" value="4">
            <input type="button" class="numbtn" name="num" value="5">
            <input type="button" class="numbtn" name="num" value="6">
            <input type="button" class="calbtn" name="op" value="-"><br><br>
            <input type="button" class="numbtn" name="num" value="1">
            <input type="button" class="numbtn" name="num" value="2">
            <input type="button" class="numbtn" name="num" value="3">
            <input type="button" class="calbtn" name="op" value="*"><br><br>
            <input type="button" class="c" name="num" value="c">
            <input type="button" class="numbtn" name="num" value="0">
            <input type="button" class="equal" name="equal" value="=">
            <input type="button" class="calbtn" name="op" value="/">
            <input type="button" class="bracketbtn" name="bracket" value="(">
            <input type="button" class="bracketbtn" name="bracket" value=")">



        </form>

        <div class="calc-history">
    <h3>Calculation History</h3>
    <ul id="historyList"></ul>
</div>

<a href="logout.php">Log out</a>


    </div>


    <script src="calculator.js"></script>
</body>

</html>