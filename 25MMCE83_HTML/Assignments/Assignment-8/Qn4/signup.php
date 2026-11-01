<?php
require_once "db.php";
$msg = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    try {
        $name = $_POST['name'];
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $sql = "INSERT INTO userdb(name, mobile, email, password) VALUES(?,?,?,?)";
        $conn = get_connection();
        $ps = $conn->prepare($sql);
        $ps->bind_param("ssss", $name, $mobile, $email, $password);
        if ($ps->execute()) {
            $msg = "Account Created Successfully";
        }
        $ps->close();
        $conn->close();
    } catch (mysqli_sql_exception $se) {
        $msg = "Email already exists or database error.";
    }
}

include_once "navbar.php";
?>
<main class="container min-vh-75 py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card ">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h3><i class="bi bi-person-plus"></i> Create Account</h3>
                </div>
                <div class="card-body p-4">
                    <p class="text-success text-center">
                        <?php echo $msg; ?>
                    </p>
                    <form action="signup.php" method="post">
                        <input type="text" name="name" class="form-control mb-3" placeholder="Full Name" required>
                        <input type="tel" name="mobile" class="form-control mb-3" placeholder="Mobile Number" required>

                        <input type="email" name="email" class="form-control mb-3" placeholder="Email Address" required>

                        <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

                        <button type="submit" class="btn btn-primary w-100">
                            Register
                        </button>

                    </form>

                    <p class="text-center mt-3 mb-0">
                        Already have an account?
                        <a href="login.php">Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include_once "footer.php"; ?>
