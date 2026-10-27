<?php
$msg = "";
try {
    if (!isset($_COOKIE['name'], $_COOKIE['fname'],$_COOKIE['dob'],$_COOKIE['mobile'],$_COOKIE['email'], $_COOKIE['address'])) {
        throw new Exception("Cookies are missing");
    }
    $name = $_COOKIE['name'];
    $fname = $_COOKIE['fname'];
    $dob = $_COOKIE['dob'];
    $mobile = $_COOKIE['mobile'];
    $email = $_COOKIE['email'];
    $address = $_COOKIE['address'];

} catch (Exception $e) {
    $msg = "Some details are missing or your cookies have expired. Please complete both forms again.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Details</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h3 class="text-center mb-4">Verify Your Details</h3>

    <?php if ($msg != "") { ?>

        <div class="alert alert-warning">
            <?php echo $msg; ?>
        </div>

    <?php } else { ?>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Father Name</th>
                        <th>Date of Birth</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Address</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $fname; ?></td>
                        <td><?php echo $dob; ?></td>
                        <td><?php echo $mobile; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><?php echo $address; ?></td>
                    </tr>
                </tbody>
            </table>
                <div class="text-center mt-3">
                    <a href="submit.php" class="btn btn-success">
                        Confirm and Submit
                    </a>
                </div>
            </div>
        </div>

    <?php } ?>

</div>

</body>
</html>
