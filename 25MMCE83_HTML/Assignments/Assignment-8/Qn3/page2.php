<?php

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['num2'] = (float)$_POST['num2'];
    header("Location: page3.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Enter the 2nd NUMBER:</h2>
    <FORM method="post">
        Enter the second Number:
        <input type="number" name="num2" required>
        <input type="submit" value="Next">
    </form>
</body>
</html>