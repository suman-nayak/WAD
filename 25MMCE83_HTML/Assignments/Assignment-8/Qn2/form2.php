<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    setcookie("mobile", $mobile, time() + 60, "/");
    setcookie("email", $email, time() + 60, "/");
    setcookie("address", $address, time() + 60, "/");
    header("Location: verify.php");
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Info</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card ">
                    <div class="card-header">
                        <h5 class="mb-0">Contact Info</h5>
                    </div>

                    <div class="card-body">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="mobile" class="form-label">
                                    Mobile
                                </label>
                                <input type="tel" id="mobile" name="mobile"
                                       class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    Email
                                </label>
                                <input type="email" id="email" name="email"
                                       class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">
                                    Address
                                </label>
                                <textarea id="address" name="address"
                                          class="form-control"
                                          rows="3" required></textarea>
                            </div>

                            <button type="submit"
                                    class="btn btn-primary w-100">
                                Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
