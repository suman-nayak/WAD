
<?php

session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['num1'] = (float)$_POST['num1'];
    header("Location: page2.php");
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
    <h2>Enter the 1st NUMBER:</h2>
    <FORM method="post">
        Enter the first Number:
        <input type="number" name="num1" required>
        <input type="submit" value="Next">
    </form>
</body>
</html>