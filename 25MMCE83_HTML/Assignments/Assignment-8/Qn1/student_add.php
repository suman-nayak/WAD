<?php
include_once "navbar.php";
require_once "Student.php";

$msg = "";
$error = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $name = trim($_POST['name']);
        $gender = $_POST['gender'];
        $dob = $_POST['dob'];
        $mobile = trim($_POST['mobile']);
        $email = trim($_POST['email']);
        $address = trim($_POST['address']);
        $department = $_POST['department'];
        $cgpa = $_POST['cgpa'];

        if (
            $name == "" || $mobile == "" || $email == "" ||
            $address == "" || !filter_var($email, FILTER_VALIDATE_EMAIL) ||
            !is_numeric($cgpa) || $cgpa < 0 || $cgpa > 10 ||
            !in_array($gender, ['Male', 'Female', 'Other']) ||
            !in_array($department, ['CSE', 'CST', 'CEN', 'MSc', 'MCA'])
        ) {
            throw new Exception("Please enter valid student details.");
        }

        $p = new Student();

        $res = $p->add_student(
            $name, $gender, $dob, $mobile,
            $email, $address, $department, $cgpa
        );

        if ($res) {
            $msg = "Student Added Successfully";
            $error = false;
        }

    } catch (mysqli_sql_exception $se) {
        if ($se->getCode() == 1062) {
            $msg = "Mobile number or email already exists.";
        } else {
            $msg = "DB Error: " . $se->getMessage();
        }

        $error = true;

    } catch (Exception $e) {
        $msg = "Error: " . $e->getMessage();
        $error = true;
    }
}
?>

<main class="container py-3 min-vh-75">

    <div class="row">
        <div class="col-md-7 mx-auto">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Add Student</h3>
                </div>

                <div class="card-body">

                    <?php if (strlen($msg) > 0) { ?>
                        <div class="alert alert-<?php echo $error ? "danger" : "success"; ?> alert-dismissible fade show"
                             role="alert">

                            <strong><?php echo htmlspecialchars($msg); ?></strong>

                            <button type="button" class="btn-close"
                                    data-bs-dismiss="alert"></button>
                        </div>
                    <?php } ?>

                    <form action="student_add.php" method="post">

                        <label>Name</label>
                        <input type="text" name="name"
                               class="form-control mb-2" required
                               maxlength="100">

                        <label>Gender</label>
                        <div class="mb-2">
                            <input type="radio" name="gender"
                                   value="Male" required> Male

                            <input type="radio" name="gender"
                                   value="Female" class="ms-3"> Female

                            <input type="radio" name="gender"
                                   value="Other" class="ms-3"> Other
                        </div>

                        <label>Date of Birth</label>
                        <input type="date" name="dob"
                               class="form-control mb-2" required>

                        <label>Mobile</label>
                        <input type="tel" name="mobile"
                               class="form-control mb-2"
                               pattern="[0-9]{10,15}"
                               maxlength="15" required>

                        <label>Email</label>
                        <input type="email" name="email"
                               class="form-control mb-2"
                               maxlength="100" required>

                        <label>Address</label>
                        <textarea name="address" rows="3"
                                  class="form-control mb-2"
                                  required></textarea>

                        <label>Department</label>
                        <select name="department"
                                class="form-select mb-2" required>
                            <option value="">Select Department</option>
                            <option value="CSE">CSE</option>
                            <option value="CST">CST</option>
                            <option value="CEN">CEN</option>
                            <option value="MSc">MSc</option>
                            <option value="MCA">MCA</option>
                        </select>

                        <label>CGPA</label>
                        <input type="number" name="cgpa"
                               class="form-control mb-3"
                               min="0" max="10" step="0.01" required>

                        <input type="submit" value="ADD"
                               class="btn btn-primary">

                        <a href="student_display.php"
                           class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include_once "footer.php"; ?>