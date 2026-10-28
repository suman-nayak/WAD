<?php
include_once "navbar.php";
require_once "db.php";

$msg = "";
$error = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $department = $_POST['department'];
        $cgpa = $_POST['cgpa'];

        $sql = "INSERT INTO students
                (name, gender, dob, mobile, email, address, department, cgpa)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $conn = get_connection();
        $ps = $conn->prepare($sql);

        $ps->bind_param(
            "sssssssd",
            $name, $gender, $dob, $mobile,
            $email, $address, $department, $cgpa
        );

        $res = $ps->execute();

        if ($res) {
            $msg = "Student Added Successfully";
            $error = false;
        }

        $conn->close();

    } catch (mysqli_sql_exception $se) {
        $msg = "DB Error: " . $se->getMessage() . " @Line: " . $se->getLine();
        $error = true;

    } catch (Exception $e) {
        $msg = "Error: " . $e->getMessage() . " @Line: " . $e->getLine();
        $error = true;
    }
}
?>

<main class="container py-3 min-vh-75">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Add Student</h3>
                </div>

                <div class="card-body">
                    <?php if (strlen($msg) > 0) { ?>
                        <div class="alert alert-<?php echo $error ? "danger" : "success"; ?> alert-dismissible fade show" role="alert">
                            <strong><?php echo $msg; ?></strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>

                    <form action="student_add.php" method="post">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control mb-2" required>

                        <label>Gender</label>
                        <div class="mb-2">
                            <input type="radio" name="gender" value="Male" required> Male
                            <input type="radio" name="gender" value="Female" class="ms-2"> Female
                            <input type="radio" name="gender" value="Other" class="ms-2"> Other
                        </div>

                        <label>Date of Birth</label>
                        <input type="date" name="dob" class="form-control mb-2" required>

                        <label>Mobile</label>
                        <input type="tel" name="mobile" class="form-control mb-2" required>

                        <label>Email</label>
                        <input type="email" name="email" class="form-control mb-2" required>

                        <label>Address</label>
                        <textarea name="address" rows="5" class="form-control mb-2" required></textarea>

                        <label>Department</label>
                        <select name="department" class="form-control mb-2" required>
                            <option value="CSE">CSE</option>
                            <option value="CST">CST</option>
                            <option value="CEN">CEN</option>
                            <option value="MSc">MSc</option>
                            <option value="MCA">MCA</option>
                        </select>

                        <label>CGPA</label>
                        <input type="text" name="cgpa" class="form-control mb-2" required>

                        <input type="submit" value="ADD" class="btn btn-primary">
                        <a href="student_display.php" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include_once "footer.php"; ?>
