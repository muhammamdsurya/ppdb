<?php
require "../functions.php";

if (isset($_POST["daftar"])) {
  if (daftar($_POST) > 0) {
    echo "<div class='alert alert-success'>Berhasil mendaftar, silakan login.</div>
            <meta http-equiv='refresh' content='2; url= ../login.php'/>  ";
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

  <title>Register</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../assets/css/sb-admin-2.css" rel="stylesheet">
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

  <div class="container d-flex align-items-center">

    <div class="container ">
      <div class="card o-hidden border-0 shadow-lg ">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">
            <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
            <div class="col-lg-7">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Registrasi</h1>
                </div>
                <form class="user" method="POST">
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <input type="text" class="form-control form-control-user" name="nm_dpn" id="exampleFirstName" placeholder="Nama Depan" required>
                    </div>
                    <div class="col-sm-6">
                      <input type="text" class="form-control form-control-user" name="nm_blkg" id="exampleLastName" placeholder="Nama Belakang" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <input type="email" class="form-control form-control-user" name="email" id="exampleInputEmail" placeholder="Email" required>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <input type="password" class="form-control form-control-user" name="password" id="exampleInputPassword" placeholder="Password" required>
                    </div>
                    <div class="col-sm-6">
                      <input type="password" class="form-control form-control-user" name="password2" id="exampleRepeatPassword" placeholder="Ulangi Password" oninput="checkPasswordMatch()" required>
                    </div>
                  </div>
                  <p id="passwordError" class="text-danger text-center ">
                  </p>
                  <button type="submit" id="daftar" name="daftar" class="btn btn-primary btn-user btn-block ">
                    Daftar
                  </button>
                  <hr>
                </form>
                <div class="text-center">
                  <a class="small" href="../login.php">Punya Akun? Login!</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.js"></script>
    <script src="../assets/js/function.js"></script>

</body>

</html>