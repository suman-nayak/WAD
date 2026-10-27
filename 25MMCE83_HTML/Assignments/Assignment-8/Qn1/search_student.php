<?php

include_once "navbar.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $search_key = $_POST['search_key'];
    require_once "db.php"; 
    $sql = "SELECT * FROM students WHERE name LIKE '%$search_key%'";
    $conn = get_connection();
    $ps = $conn->prepare($sql);
    $ps->execute();
    $rs = $ps->get_result();
}
?>

<main class="container py-3 min-vh-75">
    <h1 class="h3 text-center">Search Result</h1>
    <?php
    $n_r = isset($rs) ? $rs->num_rows : 0;
    if ($n_r < 1) {
    echo "<h4 class='text-center text-muted mt-4'>No Item Found</h4>";
    }
    ?>
    <table class="table table-striped table-bordered mt-3">
        <thead class="table-primary">
            <tr>
                <th>student_id</th>
                <th>name</th>
                <th>mobile</th>
                <th>email</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php foreach($products as $p) {  ?>
                <tr>
                    <td><?php echo $p['student_id'] ?></td>
                    <td><?php echo $p['name'] ?></td>
                    <td><?php echo $p['mobile'] ?></td>
                    <td><?php echo $p['email'] ?></td>
                    <td>
                        <a href="student_details.php?pid=<?php echo $p['id'] ?>" class="text-decoration-none">
                            <i class="bi bi-eye fs-4 me-2 text-primary"></i>
                        </a>
                        <a href="student_update.php?pid=<?php echo $p['id'] ?>" class="text-decoration-none">
                            <i class="bi bi-pencil fs-4 me-2 text-warning"></i>
                        </a>
                        <a href="student_display.php?pid=<?php echo $p['id'] ?>" class="text-decoration-none">
                            <i class="bi bi-eye fs-4 me-2 text-primary"></i>
                        </a>
                        <a
                            href="student_delete.php?pid=<?php echo $p['id'] ?>"
                            onclick="return confirm('Are you sure?')"
                            class="text-decoration-none">
                            <i class="bi bi-trash fs-4 me-2 text-danger"></i>
                        </a>
                    </td>
                </tr>
        <?php
    </table>
</main>