<?php

session_start();


$num1 = $_SESSION['num1'];
$num2 = $_SESSION['num2'];
$sum = $num1 + $num2;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>The sum is</h1>
    First Number: <?php echo $num1;?>
    <br><br>

    Second Number: <?php echo $num2;?>
    <br><br>

    Sum:<?php echo $sum;?>
</body>
</html>