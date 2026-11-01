<?php include_once "navbar.php"; ?>

<main class="container min-vh-75 py-5">

    <div class="text-center py-5">

        <i class="bi bi-shield-lock text-primary"
           style="font-size:80px;"></i>

        <h1 class="display-4 fw-bold mt-3">
            Authentication System
        </h1>

        <?php if(isset($_SESSION['email'])) { ?>

            <a href="dashboard.php" class="btn btn-primary btn-lg">
                Go to Dashboard
            </a>

        <?php } else { ?>

            <a href="signup.php" class="btn btn-primary btn-lg">
                Get Started
            </a>

            <a href="login.php" class="btn btn-outline-primary btn-lg">
                Login
            </a>

        <?php } ?>

    </div>

</main>

<?php include_once "footer.php"; ?>