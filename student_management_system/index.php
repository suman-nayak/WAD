<?php
include_once "navbar.php";
?>

<main class="container py-5 min-vh-75">
    <div class="text-center">
        <h1 class="display-3 my-4">Student Management System</h1>

        <p class="lead">
            Manage student information using PHP, MySQL and Bootstrap.
        </p>

        <a href="student_add.php" class="btn btn-primary btn-lg me-2">
            <i class="bi bi-person-plus"></i> Add Student
        </a>

        <a href="student_display.php" class="btn btn-success btn-lg">
            <i class="bi bi-people"></i> View Students
        </a>
    </div>
</main>

<?php
include_once "footer.php";
?>