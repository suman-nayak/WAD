<?php
require_once "db.php";

try {

    // Check whether all cookies are available
    if (
        !isset(
            $_COOKIE['name'],
            $_COOKIE['fname'],
            $_COOKIE['dob'],
            $_COOKIE['mobile'],
            $_COOKIE['email'],
            $_COOKIE['address']
        )
    ) {
        throw new Exception(
            "Registration details are missing or expired. Please fill in both forms again."
        );
    }

    // Get data from cookies
    $name = $_COOKIE['name'];
    $fname = $_COOKIE['fname'];
    $dob = $_COOKIE['dob'];
    $mobile = $_COOKIE['mobile'];
    $email = $_COOKIE['email'];
    $address = $_COOKIE['address'];

    // Database insertion query
    $sql = "INSERT INTO survey
            (name, fname, dob, mobile, email, address)
            VALUES (?, ?, ?, ?, ?, ?)";

    // Get database connection
    $conn = get_connection();

    if ($conn === null) {
        throw new Exception("Database connection failed.");
    }

    // Prepare and execute query
    $ps = $conn->prepare($sql);

    $ps->bind_param(
        "ssssss",
        $name,
        $fname,
        $dob,
        $mobile,
        $email,
        $address
    );

    $ps->execute();

    // Clear all cookies after successful insertion
    setcookie('name', '', time() - 3600, '/');
    setcookie('fname', '', time() - 3600, '/');
    setcookie('dob', '', time() - 3600, '/');
    setcookie('mobile', '', time() - 3600, '/');
    setcookie('email', '', time() - 3600, '/');
    setcookie('address', '', time() - 3600, '/');

    // Display success message
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>Registration Successful</title>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css'
              rel='stylesheet'>
    </head>
    <body>
        <div class='container mt-5'>
            <div class='alert alert-success text-center'>
                <h3>Registration Successful!</h3>
                <p>Your details have been saved successfully.</p>
            </div>
        </div>
    </body>
    </html>";

    // Close resources
    $ps->close();
    $conn->close();

} catch (mysqli_sql_exception $e) {

    echo "<div class='container mt-5'>
            <div class='alert alert-danger'>
                Registration failed. Please check the database and try again.
            </div>
          </div>";

} catch (Exception $e) {

    echo "<div class='container mt-5'>
            <div class='alert alert-warning'>"
            echo "Error: " . $e->getMessage();
            "</div>
          </div>";
}
?>