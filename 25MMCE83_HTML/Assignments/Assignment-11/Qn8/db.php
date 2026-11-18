
<?php
function get_connection(){
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "25mmce83";

    $conn = new mysqli($host, $user, $password, $database);

    return $conn;
}
?>
