    <?php  
    include_once "navbar.php";
    $name=$_SESSION['name']?? '';
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
    </head>
    <body>
        <h1>Welcome <?php echo $name?></h1>
    </body>
    </html>
