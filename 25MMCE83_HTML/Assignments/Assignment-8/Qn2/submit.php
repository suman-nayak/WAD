<?php
require_once "db.php";

try {
    if (
        !isset($_COOKIE['name']) ||
        !isset($_COOKIE['fname']) ||
        !isset($_COOKIE['dob']) ||
        !isset($_COOKIE['mobile']) ||
        !isset($_COOKIE['email']) ||
        !isset($_COOKIE['address'])
    ) {
        throw new Exception("Please fill in both forms again.");
    }

    $name = $_COOKIE['name'];
    $fname = $_COOKIE['fname'];
    $dob = $_COOKIE['dob'];
    $mobile = $_COOKIE['mobile'];
    $email = $_COOKIE['email'];
    $address = $_COOKIE['address'];

    $sql = "INSERT INTO survey
            (name, fname, dob, mobile, email, address)
            VALUES (?, ?, ?, ?, ?, ?)";

    $conn = get_connection();
    $ps = $conn->prepare($sql);

    $ps->bind_param(
        "ssssss",
        $name, $fname, $dob, $mobile, $email, $address
    );

    $ps->execute();

    setcookie('name', '', time() - 3600, '/');
    setcookie('fname', '', time() - 3600, '/');
    setcookie('dob', '', time() - 3600, '/');
    setcookie('mobile', '', time() - 3600, '/');
    setcookie('email', '', time() - 3600, '/');
    setcookie('address', '', time() - 3600, '/');

    echo "Registration Successful! Your details have been saved.";

    $ps->close();
    $conn->close();

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
