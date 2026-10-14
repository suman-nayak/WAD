<?php
if (!isset($_GET['sid']) || !ctype_digit($_GET['sid'])) {
    header("location:student_display.php");
    exit;
}

$id = (int) $_GET['sid'];

require_once "Student.php";

try {
    $s = new Student();
    $student = $s->get_student_by_id($id);

    if (!$student) {
        ?>
        <script>
            alert("Invalid Student ID");
            window.location = "student_display.php";
        </script>
        <?php
        exit;
    }

    $result = $s->delete_student($id);

    if ($result) {
        ?>
        <script>
            alert("Student Deleted Successfully");
            window.location = "student_display.php";
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("Student Not Deleted");
            window.location = "student_display.php";
        </script>
        <?php
    }

} catch (mysqli_sql_exception $se) {
    ?>
    <script>
        alert("Database Error: Unable to delete student");
        window.location = "student_display.php";
    </script>
    <?php
}
?>