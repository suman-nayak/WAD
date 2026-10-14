<?php
include_once "navbar.php";
require_once "Student.php";

$s = new Student();
$students = $s->all_students();
?>

<main class="container py-3 min-vh-75">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">Student Details</h1>

        <a href="student_add.php" class="btn btn-primary">
            <i class="bi bi-person-plus"></i> Add Student
        </a>
    </div>

    <?php if (count($students) <= 0) { ?>
        <div class="alert alert-info">No students found.</div>
    <?php } else { ?>

        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>DOB</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Department</th>
                        <th>CGPA</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($students as $student) { ?>
                        <tr>
                            <td><?php echo $student['id']; ?></td>

                            <td>
                                <?php echo htmlspecialchars($student['name']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($student['gender']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($student['dob']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($student['mobile']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($student['email']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($student['address']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($student['department']); ?>
                            </td>

                            <td>
                                <?php echo htmlspecialchars($student['cgpa']); ?>
                            </td>

                            <td class="text-nowrap">
                                <a href="student_details.php?sid=<?php echo $student['id']; ?>"
                                   class="text-decoration-none" title="Details">
                                    <i class="bi bi-eye fs-4 me-2 text-primary"></i>
                                </a>

                                <a href="student_update.php?sid=<?php echo $student['id']; ?>"
                                   class="text-decoration-none" title="Update">
                                    <i class="bi bi-pencil fs-4 me-2 text-warning"></i>
                                </a>

                                <a href="student_delete.php?sid=<?php echo $student['id']; ?>"
                                   onclick="return confirm('Are you sure you want to delete this student?')"
                                   class="text-decoration-none" title="Delete">
                                    <i class="bi bi-trash fs-4 text-danger"></i>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    <?php } ?>
</main>

<?php include_once "footer.php"; ?>