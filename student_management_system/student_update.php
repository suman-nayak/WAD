<?php
if (!isset($_GET['sid']) || !ctype_digit($_GET['sid'])) {
    header("location:student_display.php");
    exit;
}

$id = (int) $_GET['sid'];

require_once "Student.php";

$msg = "";
$error = false;

$s = new Student();
$student = $s->get_student_by_id($id);

if (!$student) {
    include_once "navbar.php";
    ?>
    <main class="container py-3 min-vh-75">
        <div class="alert alert-danger">Invalid Student ID.</div>
        <a href="student_display.php" class="btn btn-secondary">Back</a>
    </main>
    <?php
    include_once "footer.php";
    exit;
}

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

        if ($name == "" || $dob == "" || $address == "") {
            throw new Exception("All fields are required.");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Enter a valid email address.");
        }

        if (!preg_match('/^[0-9]{10,15}$/', $mobile)) {
            throw new Exception("Enter a valid mobile number.");
        }

        if (!is_numeric($cgpa) || $cgpa < 0 || $cgpa > 10) {
            throw new Exception("CGPA must be between 0 and 10.");
        }

        if ($dob > date('Y-m-d')) {
            throw new Exception("Date of birth cannot be in the future.");
        }

        if (!in_array($gender, ['Male', 'Female', 'Other']) ||
            !in_array($department, ['CSE', 'CST', 'CEN', 'MSc', 'MCA'])) {
            throw new Exception("Select a valid gender and department.");
        }

        $res = $s->update_student(
            $id,
            $name,
            $gender,
            $dob,
            $mobile,
            $email,
            $address,
            $department,
            $cgpa
        );

        if ($res) {
            $msg = "Student Updated Successfully";
            $error = false;
            $student = $s->get_student_by_id($id);
        }

    } catch (mysqli_sql_exception $se) {
        if ($se->getCode() == 1062) {
            $msg = "Mobile number or email already exists.";
        } else {
            $msg = "DB Error: " . $se->getMessage();
        }

        $error = true;

    } catch (Exception $e) {
        $msg = $e->getMessage();
        $error = true;
    }
}

include_once "navbar.php";
?>

<main class="container py-3 min-vh-75">
    <div class="row">
        <div class="col-md-8 mx-auto">

            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3>Update Student</h3>
                </div>

                <div class="card-body">

                    <?php if ($msg != "") { ?>
                        <div class="alert alert-<?php echo $error ? 'danger' : 'success'; ?> alert-dismissible fade show">
                            <strong><?php echo htmlspecialchars($msg); ?></strong>
                            <button type="button" class="btn-close"
                                    data-bs-dismiss="alert"></button>
                        </div>
                    <?php } ?>

                    <form action="student_update.php?sid=<?php echo $id; ?>"
                          method="post">

                        <label>Name</label>
                        <input type="text" name="name"
                               value="<?php echo htmlspecialchars($student['name']); ?>"
                               class="form-control mb-3" required maxlength="100">

                        <label>Gender</label>
                        <select name="gender" class="form-select mb-3" required>
                            <?php foreach (['Male', 'Female', 'Other'] as $g) { ?>
                                <option value="<?php echo $g; ?>"
                                    <?php echo $student['gender'] == $g ? 'selected' : ''; ?>>
                                    <?php echo $g; ?>
                                </option>
                            <?php } ?>
                        </select>

                        <label>Date of Birth</label>
                        <input type="date" name="dob"
                               value="<?php echo htmlspecialchars($student['dob']); ?>"
                               max="<?php echo date('Y-m-d'); ?>"
                               class="form-control mb-3" required>

                        <label>Mobile</label>
                        <input type="tel" name="mobile"
                               value="<?php echo htmlspecialchars($student['mobile']); ?>"
                               pattern="[0-9]{10,15}"
                               class="form-control mb-3" required>

                        <label>Email</label>
                        <input type="email" name="email"
                               value="<?php echo htmlspecialchars($student['email']); ?>"
                               class="form-control mb-3" required maxlength="100">

                        <label>Address</label>
                        <textarea name="address" rows="3"
                                  class="form-control mb-3"
                                  required><?php echo htmlspecialchars($student['address']); ?></textarea>

                        <label>Department</label>
                        <select name="department" class="form-select mb-3" required>
                            <?php foreach (['CSE', 'CST', 'CEN', 'MSc', 'MCA'] as $d) { ?>
                                <option value="<?php echo $d; ?>"
                                    <?php echo $student['department'] == $d ? 'selected' : ''; ?>>
                                    <?php echo $d; ?>
                                </option>
                            <?php } ?>
                        </select>

                        <label>CGPA</label>
                        <input type="number" name="cgpa"
                               value="<?php echo htmlspecialchars((string)$student['cgpa']); ?>"
                               min="0" max="10" step="0.01"
                               class="form-control mb-3" required>

                        <input type="submit" value="Update"
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