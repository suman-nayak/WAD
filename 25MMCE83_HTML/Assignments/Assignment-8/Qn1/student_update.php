<?php
if (!isset($_GET['sid']) || !ctype_digit($_GET['sid']) ||
    (int)$_GET['sid'] < 1) {
    header("location:student_display.php");
    exit;
}

$id = (int)$_GET['sid'];

require_once "Student.php";
include_once "navbar.php";

$msg = "";
$error = false;

$p_obj = new Student();
$p = $p_obj->get_student_by_id($id);

if (!$p) {
    echo '<main class="container py-4 min-vh-75">
          <div class="alert alert-danger">Invalid Student ID</div>
          <a href="student_display.php" class="btn btn-secondary">
          Back</a></main>';

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

        if (
            $name == "" || $mobile == "" || $email == "" ||
            $address == "" || !filter_var($email, FILTER_VALIDATE_EMAIL) ||
            !is_numeric($cgpa) || $cgpa < 0 || $cgpa > 10 ||
            !in_array($gender, ['Male', 'Female', 'Other']) ||
            !in_array($department, ['CSE', 'CST', 'CEN', 'MSc', 'MCA'])
        ) {
            throw new Exception("Please enter valid student details.");
        }

        $res = $p_obj->update_student(
            $id, $name, $gender, $dob, $mobile,
            $email, $address, $department, $cgpa
        );

        if ($res) {
            $msg = "Student Updated Successfully";
            $error = false;

            $p = $p_obj->get_student_by_id($id);
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
                    <h3 class="mb-0">Update Student</h3>
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

                    <form action="student_update.php?sid=<?php echo $id; ?>"
                          method="post">

                        <label>Student ID</label>
                        <input type="text"
                               value="<?php echo $p['student_id']; ?>"
                               class="form-control mb-2" disabled>

                        <label>Name</label>
                        <input type="text" name="name"
                               value="<?php echo htmlspecialchars($p['name']); ?>"
                               class="form-control mb-2" required maxlength="100">

                        <label>Gender</label>
                        <div class="mb-2">
                            <?php foreach (['Male', 'Female', 'Other'] as $g) { ?>
                                <input type="radio" name="gender"
                                       value="<?php echo $g; ?>"
                                       <?php echo $p['gender'] == $g ? "checked" : ""; ?>
                                       required>
                                <?php echo $g; ?>
                            <?php } ?>
                        </div>

                        <label>Date of Birth</label>
                        <input type="date" name="dob"
                               value="<?php echo htmlspecialchars($p['dob']); ?>"
                               class="form-control mb-2" required>

                        <label>Mobile</label>
                        <input type="tel" name="mobile"
                               value="<?php echo htmlspecialchars($p['mobile']); ?>"
                               class="form-control mb-2"
                               pattern="[0-9]{10,15}" maxlength="15" required>

                        <label>Email</label>
                        <input type="email" name="email"
                               value="<?php echo htmlspecialchars($p['email']); ?>"
                               class="form-control mb-2" maxlength="100" required>

                        <label>Address</label>
                        <textarea name="address" rows="3"
                                  class="form-control mb-2"
                                  required><?php echo htmlspecialchars($p['address']); ?></textarea>

                        <label>Department</label>
                        <select name="department"
                                class="form-select mb-2" required>

                            <?php foreach (['CSE', 'CST', 'CEN', 'MSc', 'MCA'] as $d) { ?>
                                <option value="<?php echo $d; ?>"
                                    <?php echo $p['department'] == $d ? "selected" : ""; ?>>
                                    <?php echo $d; ?>
                                </option>
                            <?php } ?>

                        </select>

                        <label>CGPA</label>
                        <input type="number" name="cgpa"
                               value="<?php echo htmlspecialchars($p['cgpa']); ?>"
                               class="form-control mb-3"
                               min="0" max="10" step="0.01" required>

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