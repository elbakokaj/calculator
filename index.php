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


        </form>
    </div>


    <script src="calculator.js"></script>
</body>

</html>