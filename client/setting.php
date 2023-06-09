<?php
session_start();
require "../functions.php";
require "../session.php";

if ($role !== "user") {
  header("Location: ../login.php");
}

$id = $_SESSION['id'];

$user = query("SELECT * FROM user WHERE userid = '$id'")[0];

$cek = query("SELECT COUNT(*) AS cek FROM pendaftar WHERE userid = '$id'");
$cekResult = $cek[0]['cek'];

if (isset($_POST["edit"])) {
  if (editUser($_POST) > 0) {
    echo "<div class='alert alert-success'>Berhasil Diubah</div>
    <meta http-equiv='refresh' content='2'>";
  } else {
    echo "<div class='alert alert-danger'>Gagal Diubah</div>
    <meta http-equiv='refresh' content='2'>";
  }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Pendaftaran</title>

  <!-- Custom fonts for this template-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

  <!-- Custom styles for this template-->
  <link href="../assets/css/sb-admin-2.css" rel="stylesheet" />

  <style>

  </style>
</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
          <div class="sidebar-brand-icon mt-4">
            <?php if (!empty($user["foto"]) && file_exists('../assets/img/' . $user["foto"])) : ?>
              <img src="../assets/img/<?= $user["foto"]; ?>" style="width: 70px; height: 70px" class="rounded-circle" alt="">
            <?php else : ?>
              <img src="../assets/img/person_2.jpg" style="width: 70px; height: 70px" class="rounded-circle" alt="">
            <?php endif; ?>
          </div>
        </div>
        <div class="sidebar-brand-text mx-3"><?= $user["nm_dpn"]; ?></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider mt-5" />

      <!-- Nav Item - Dashboard -->
      <li class="nav-item mt-5">
        <a class="nav-link" href="home.php">
          <i class=" fas fa-home"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider my-0" />

      <!-- Nav Item - Formulir -->
      <li class="nav-item">
        <a class="nav-link" href="form.php">
          <i class="fab fa-wpforms"></i>
          <span>Data Formulir</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider my-0" />

      <!-- Nav Item - Dokumen -->
      <li class="nav-item">
        <?php if ($cekResult > 0) : ?>
          <a class="nav-link" href="doc.php">
          <?php else : ?>
            <a class="nav-link" onclick="showSuccessAlert()">
            <?php endif; ?>
            <i class="fas fa-file-upload"></i>
            <span>Dokumen</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider" />

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="mr-auto ml-md-3 my-auto ">
            <h5 id="time"></h5>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Nav Item - Search Dropdown (Visible Only XS) -->

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 "><?= $_SESSION["email"]; ?></span>
                <?php
                $foto = $user["foto"];
                $pathFoto = '../assets/img/' . $foto;
                if (!empty($foto) && file_exists($pathFoto)) {
                  // Menampilkan gambar user jika ada dan file gambar tersebut ada
                ?>
                  <img src="../assets/img/<?= $foto; ?>" style="width: 50px; height: 50px;" class="rounded-circle" alt="">
                <?php
                } else {
                  // Menampilkan gambar default jika gambar belum ada
                ?>
                  <img src="../assets/img/person_2.jpg" style="width: 50px; height: 50px;" class="rounded-circle" alt="">
                <?php
                }
                ?>
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="profile.php">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="setting.php">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Setting Profile</h1>

          <form class="shadow col-lg-8 col-md-11 p-3" method="post" enctype="multipart/form-data">
            <input type="hidden" name="fotoLama" value="<?= $user["foto"]; ?>">
            <div class="row">
              <?php
              $foto = $user["foto"];
              $pathFoto = '../assets/img/' . $foto;
              if (!empty($foto) && file_exists($pathFoto)) {
                // Menampilkan gambar user jika ada dan file gambar tersebut ada
              ?>
                <img src="../assets/img/<?= $foto; ?>" style="width: 300px; height: fit-content" class="mx-auto my-3" alt="">
              <?php
              } else {
                // Menampilkan gambar default jika gambar belum ada
              ?>
                <img src="../assets/img/person_2.jpg" style="width: 300px; height: fit-content" class="mx-auto my-3" alt="">
              <?php
              }
              ?>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nama Depan</label>
                    <input type="text" class="form-control" name="nm_dpn" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $user["nm_dpn"]; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nama Belakang</label>
                    <input type="text" class="form-control" name="nm_blkg" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $user["nm_blkg"]; ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $user["user_email"]; ?>">
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Ubah Foto</label>
                    <input type="file" class="form-control" name="foto" id="exampleInputEmail1" aria-describedby="emailHelp">
                  </div>
                </div>
                <div class="col ">
                  <button class="btn btn-primary btn-lg px-5" type="submit" name="edit">Edit</button>
                </div>
              </div>
            </div>
          </form>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          Select "Logout" below if you are ready to end your current session.
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">
            Cancel
          </button>
          <a class="btn btn-primary" href="../logout.php">Logout</a>
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
  <script src="../assets/js/event.js"></script>
</body>

</html>