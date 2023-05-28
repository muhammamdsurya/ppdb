<?php
session_start();
require "../functions.php";
require "../session.php";

if ($role !== "user") {
  header("Location: ../login.php");
}

$id = $_SESSION["id"];
$user = query("SELECT user.*, pendaftar.status
FROM user
LEFT JOIN doc ON user.userid = doc.userid
LEFT JOIN pendaftar ON user.userid = pendaftar.userid
WHERE user.userid = '$id'")[0];

$cekDoc = query("SELECT COUNT(*) AS count
              FROM doc
              WHERE userid = '$id'")[0];



$cek = query("SELECT COUNT(*) AS cek FROM pendaftar WHERE userid = '$id'");
$cekResult = $cek[0]['cek'];
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
        <div class="sidebar-brand-icon mt-4">
          <?php if (!empty($user["foto"]) && file_exists('../assets/img/' . $user["foto"])) : ?>
            <img src="../assets/img/<?= $user["foto"]; ?>" style="width: 70px; height: 70px" class="rounded-circle" alt="">
          <?php else : ?>
            <img src="../assets/img/person_2.jpg" style="width: 70px; height: 70px" class="rounded-circle" alt="">
          <?php endif; ?>
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

          <form class="mr-auto ml-md-3 my-auto ">
            <h5 id="time"></h5>
          </form>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <h5 id="time"></h5>
            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 "><?= $user["user_email"]; ?></span>
                <?php if (!empty($user["foto"]) && file_exists('../assets/img/' . $user["foto"])) : ?>
                  <img src="../assets/img/<?= $user["foto"]; ?>" style="width: 50px; height: 50px;" class="rounded-circle" alt="">
                <?php else : ?>
                  <img src="../assets/img/person_2.jpg" style="width: 50px; height: 50px;" class="rounded-circle" alt="">
                <?php endif; ?>
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
          <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>

          <!-- Card 1 -->
          <div class="row ml-3">
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-s font-weight-bold text-primary text-uppercase mb-1">
                        Berkas Upload</div>
                      <?php if ($cekDoc["count"] > 0) : ?>
                        <div class="h4 mb-0 font-weight-bold text-success">Sudah Upload</div>
                      <?php else : ?>
                        <div class="h4 mb-0 font-weight-bold text-gray-800">Belum Upload</div>
                      <?php endif; ?>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-lg"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Card 2 -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-s font-weight-bold text-primary text-uppercase mb-1">
                        Status</div>
                      <?php if ($user["status"] === "Belum Terkonfirmasi") : ?>
                        <div class="h4 mb-0 font-weight-bold text-gray-800"><?= $user["status"]; ?></div>
                      <?php elseif ($user["status"] === "Terkonfirmasi") : ?>
                        <div class="h4 mb-0 font-weight-bold text-success"><?= $user["status"]; ?></div>
                      <?php else : ?>
                        <div class="h4 mb-0 font-weight-bold text-gray-800">Belum Mendaftar</div>
                      <?php endif; ?>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-sync fa-lg"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Announcement</h1>

          <div class="announcement shadow h-100 mx-3 mt-4">
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Error veritatis iusto doloremque eos recusandae fugiat atque vel natus ullam enim, dolorum, possimus blanditiis! Odit debitis eius laborum impedit! Quod, aliquid!</li>
              <li class="list-group-item">1. Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, eaque?</li>
              <li class="list-group-item">2. Lorem ipsum dolor sit amet consectetur adipisicing elit.</li>
              <li class="list-group-item">3. Lorem ipsum dolor sit amet consectetur.</li>
              <li class="list-group-item">4. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aspernatur, libero.</li>
            </ul>
          </div>

        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
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