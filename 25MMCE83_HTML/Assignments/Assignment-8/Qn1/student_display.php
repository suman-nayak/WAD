<?php
include_once "navbar.php";
require_once "Student.php";

$p = new Student();
$students = $p->all_students();
?>

<main class="container py-3 min-vh-75">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">Available Students</h1>

        <a href="student_add.php" class="btn btn-primary">
            <i class="bi bi-person-plus"></i> Add Student
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">

            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>CGPA</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($students as $i => $p) { ?>
                    <tr>
                        <td><?php echo $i + 1; ?></td>

                        <td><?php echo $p['student_id']; ?></td>

                        <td>
                            <?php echo htmlspecialchars($p['name']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($p['department']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($p['mobile']); ?>
                        </td>

                        <td>
                            <?php echo htmlspecialchars($p['email']); ?>
                        </td>

                        <td><?php echo $p['cgpa']; ?></td>

                        <td class="text-nowrap">
                            <a href="student_details.php?sid=<?php echo $p['student_id']; ?>"
                               class="text-decoration-none"
                               title="Details">
                                <i class="bi bi-eye fs-4 me-2 text-primary"></i>
                            </a>

                            <a href="student_update.php?sid=<?php echo $p['student_id']; ?>"
                               class="text-decoration-none"
                               title="Update">
                                <i class="bi bi-pencil fs-4 me-2 text-warning"></i>
                            </a>

                            <a href="student_delete.php?sid=<?php echo $p['student_id']; ?>"
                               onclick="return confirm('Are you sure you want to delete this student?')"
                               class="text-decoration-none"
                               title="Delete">
                                <i class="bi bi-trash fs-4 text-danger"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>

                <?php if (count($students) == 0) { ?>
                    <tr>
                        <td colspan="8" class="text-center">
                            No Students Found
                        </td>
                    </tr>
                <?php } ?>
            </tbody>

        </table>
    </div>

</main>

<?php include_once "footer.php"; ?>