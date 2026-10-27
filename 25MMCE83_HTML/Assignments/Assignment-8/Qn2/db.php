<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
function get_connection()
{
    $HOST="localhost";
    $USER="root";
    $PASS="";
    $DB="25mmce83";
    $PORT=3306;
    $conn=null;
    try{
        $conn=new mysqli($HOST,$USER,$PASS,$DB,$PORT);
        // echo "Connected..";
    }
    catch(mysqli_sql_exception $se)
    {
        echo "Connection Error: " . $se->getMessage() . " @Line: ". $se->getLine();
    }
    return $conn;
}
// get_connection();
?>