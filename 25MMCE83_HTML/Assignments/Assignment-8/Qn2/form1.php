<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $fname = $_POST['fname'];
    $dob = $_POST['dob'];
    setcookie("name", $name, time() + 60, "/");
    setcookie("fname", $fname, time() + 60, "/");
    setcookie("dob", $dob, time() + 60, "/");
    header("Location: form2.php");
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Personal Details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h4 class="text-center mb-0">Personal Details</h4>
          </div>
          <div class="card-body">
            <form action="" method="POST">
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text"  name="name" class="form-control" required>
              </div>
              <div class="mb-3">
                <label for="fname" class="form-label">Father Name</label>
                <input type="text"  name="fname" class="form-control" required>
              </div>
              <div class="mb-3">
                <label for="dob" class="form-label">Date Of Birth</label>
                <input type="date"  name="dob" class="form-control" required>
              </div>
              <button type="submit" class="btn btn-primary w-100">
                Submit
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
