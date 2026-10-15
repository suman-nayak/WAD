<?php
if (!isset($_GET['sid']) || !ctype_digit($_GET['sid']) ||
    (int)$_GET['sid'] < 1) {
    header("location:student_display.php");
    exit;
}

$id = (int)$_GET['sid'];

require_once "Student.php";

try {
    $p = new Student();
    $result = $p->delete_student($id);

    if ($result && $p->get_student_by_id($id) === null) {
        // The record has been deleted.
        ?>
        <script>
            alert("Student Deleted Successfully");
            window.location = "student_display.php";
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("Student Not Found or Not Deleted");
            window.location = "student_display.php";
        </script>
        <?php
    }

} catch (Exception $e) {
    ?>
    <script>
        alert("Error deleting student");
        window.location = "student_display.php";
    </script>
    <?php
}
?>