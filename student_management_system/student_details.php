<?php
if (!isset($_GET['sid']) || !ctype_digit($_GET['sid'])) {
    header("location:student_display.php");
    exit;
}

$id = (int) $_GET['sid'];

include_once "navbar.php";
require_once "Student.php";

$s = new Student();
$student = $s->get_student_by_id($id);
?>

<main class="container py-3 min-vh-75">
    <div class="row">
        <div class="col-md-8 mx-auto">

            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3>Student Details</h3>
                </div>

                <div class="card-body">

                    <?php if (isset($student)) { ?>

                        <table class="table table-bordered">
                            <tr>
                                <th>Student ID</th>
                                <td><?php echo $student['id']; ?></td>
                            </tr>

                            <tr>
                                <th>Name</th>
                                <td><?php echo htmlspecialchars($student['name']); ?></td>
                            </tr>

                            <tr>
                                <th>Gender</th>
                                <td><?php echo htmlspecialchars($student['gender']); ?></td>
                            </tr>

                            <tr>
                                <th>Date of Birth</th>
                                <td><?php echo htmlspecialchars($student['dob']); ?></td>
                            </tr>

                            <tr>
                                <th>Mobile</th>
                                <td><?php echo htmlspecialchars($student['mobile']); ?></td>
                            </tr>

                            <tr>
                                <th>Email</th>
                                <td><?php echo htmlspecialchars($student['email']); ?></td>
                            </tr>

                            <tr>
                                <th>Address</th>
                                <td><?php echo nl2br(htmlspecialchars($student['address'])); ?></td>
                            </tr>

                            <tr>
                                <th>Department</th>
                                <td><?php echo htmlspecialchars($student['department']); ?></td>
                            </tr>

                            <tr>
                                <th>CGPA</th>
                                <td><?php echo htmlspecialchars($student['cgpa']); ?></td>
                            </tr>
                        </table>

                        <a href="student_update.php?sid=<?php echo $student['id']; ?>"
                           class="btn btn-warning">
                            Update
                        </a>

                    <?php } else { ?>

                        <div class="alert alert-danger">Invalid Student ID.</div>

                    <?php } ?>

                    <a href="student_display.php" class="btn btn-secondary">
                        Back
                    </a>
                </div>
            </div>

        </div>
    </div>
</main>

<?php include_once "footer.php"; ?>