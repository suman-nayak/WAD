<?php
include_once "navbar.php";
require_once "db.php";
$msg = "";
if (!isset($_SESSION['email'])) {
    header("location:login.php");
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $newpass = $_POST['newpass'];
    $email = $_SESSION['email'];

    try {
        $sql = "UPDATE userdb SET password=? WHERE email=?";
        $conn = get_connection();
        $ps = $conn->prepare($sql);
        $ps->bind_param("ss", $newpass, $email);
        if ($ps->execute()) {
            $msg = "Password Updated Successfully";
        }
        $ps->close();
        $conn->close();
    } catch (Exception $e) {
        $msg = "Error Updating Password";
    }
}

?>
<main class="container min-vh-75 py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card ">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h3><i class="bi bi-person-gear"></i> My Profile</h3>
                </div>
                <div class="card-body p-4">
                    <h5 class="text-center mb-3">
                        <?php echo$_SESSION['name']; ?>
                    </h5>

                    <p class="text-muted text-center">
                        <?php echo$_SESSION['email']; ?>
                    </p>

                    <hr>

                    <p class="text-success text-center">
                        <?php echo $msg; ?>
                    </p>

                    <form action="profile.php" method="post">

                        <label class="form-label">New Password</label>

                        <input type="password" name="newpass" class="form-control mb-3" placeholder="Enter New Password" required>

                        <button type="submit" class="btn btn-primary w-100">Update Password </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include_once "footer.php"; ?>
