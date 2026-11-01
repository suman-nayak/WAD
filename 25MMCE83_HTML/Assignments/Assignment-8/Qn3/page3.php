
<?php
session_start();

$num1 = $_SESSION['num1'];
$num2 = $_SESSION['num2'];

$sum = $num1 + $num2;
?>

<!DOCTYPE html>
<html>
<body>
    <h2>Sum of Two Numbers</h2>

    First Number: <?php echo $num1; ?>
    <br><br>

    Second Number: <?php echo $num2; ?>
    <br><br>

    Sum: <?php echo $sum; ?>
</body>
</html>
