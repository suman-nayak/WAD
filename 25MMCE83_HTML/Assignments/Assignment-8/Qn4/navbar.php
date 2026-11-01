<?php
session_start();
$is_logged_in = isset($_SESSION['email']);
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Authication System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

  <style>
    .nav-link {
      color: #fff;
    }

    .min-vh-75 {
      min-height: 75vh;
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Auth_PG</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php">Home</a>
          </li>
          <?php if(!$is_logged_in) { ?>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="signup.php">Sign Up</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="login.php">Sign In</a>
          </li>
          <?php } else { ?>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="dashboard.php">Dashboard</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" aria-current="page" href="profile.php">Profile</a>
            </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="logout.php">Sign Out</a>
        </li>
          <?php } ?>
        </ul>    
      </div>
    </div>
  </nav>