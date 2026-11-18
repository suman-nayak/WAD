
<?php
require_once "db.php";

$qry = "SELECT * FROM student_details";

$conn = get_connection();

$ps = $conn->prepare($qry);
$ps->execute();

$res = $ps->get_result();

$students = $res->fetch_all(MYSQLI_ASSOC);

echo json_encode($students);
?>
