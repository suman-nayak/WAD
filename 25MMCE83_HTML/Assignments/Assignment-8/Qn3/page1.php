
<?php
session_start();

if(isset($_POST['submit']))
{
    $_SESSION['num1'] = $_POST['num1'];
    header("location:page2.php");
}
?>

<!DOCTYPE html>
<html>
<body>
    <h2>Enter First Number</h2>

    <form method="post">
        Enter First Number:
        <input type="number" name="num1" required>
        <input type="submit" name="submit" value="Next">
    </form>
</body>
</html>
