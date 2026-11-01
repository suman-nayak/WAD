
<?php
session_start();

if(isset($_POST['submit']))
{
    $_SESSION['num2'] = $_POST['num2'];
    header("location:page3.php");
}
?>

<!DOCTYPE html>
<html>
<body>
    <h2>Enter Second Number</h2>

    <form method="post">
        Enter Second Number:
        <input type="number" name="num2" required>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>
