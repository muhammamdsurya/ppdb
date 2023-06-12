<?php
session_start();
require 'functions.php';

if (isset($_SESSION["role"])) {
  $role = $_SESSION["role"];
  if ($role == "admin") {
    header("Location: admin/home.php");
  } else {
    header("Location: client/home.php");
  }
}

if (isset($_POST["login"])) {
  $email = $_POST["email"];
  $password = $_POST["password"];

  $admin = query("SELECT * FROM admin WHERE adm_email = '$email'");
  $user = query("SELECT * FROM user WHERE user_email = '$email'");

  if ($admin && password_verify($password, $admin[0]["password"])) {
    // Admin login berhasil
    $_SESSION["nama"] = $admin[0]["nm_dpn"];
    $_SESSION["role"] = "admin";
    $_SESSION["id"] = $admin[0]["id"];
    header("Location: admin/home.php");
  } else if ($user && password_verify($password, $user[0]["password"])) {
    // User login berhasil
    $_SESSION["email"] = $user[0]["user_email"];
    $_SESSION["nama"] = $user[0]["nm_dpn"];
    $_SESSION["role"] = "user";
    $_SESSION["id"] = $user[0]["userid"];
    header("Location: client/home.php");
  } else {
    // Username atau Password salah
    echo "<div class='alert alert-warning'>Username atau Password salah</div>
    <meta http-equiv='refresh' content='2'>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin-2.css" rel="stylesheet">

  <style>
    .container {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }
  </style>
</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg ">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                    <img src="assets/img/bg-wrap.png" alt="" width=100% class="mb-3">
                  </div>
                  <form class="user" method="POST">
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" name="email" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="password" id="exampleInputPassword" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block" name="login">
                      Login
                    </button>
                    <hr>
                  </form>
                  <div class="text-center">
                    <a class="small" href="client/daftar.php">Buat Akun!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="assets/js/sb-admin-2.min.js"></script>

</body>

</html>