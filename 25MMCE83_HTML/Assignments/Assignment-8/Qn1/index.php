<?php
include_once "navbar.php";
?>

<main class="container py-5 min-vh-75">

    <div class="text-center">
        <i class="bi bi-mortarboard-fill display-1 text-primary"></i>

        <h1 class="display-4 my-3">
            Student Management System
        </h1>

        <p class="lead">
            Manage student information easily.
        </p>

        <a href="student_add.php" class="btn btn-primary btn-lg m-2">
            <i class="bi bi-person-plus"></i> Add Student
        </a>

        <a href="student_display.php" class="btn btn-success btn-lg m-2">
            <i class="bi bi-people"></i> Display Students
        </a>
    </div>

</main>

<?php include_once "footer.php"; ?>