<?php
session_start();
require "../functions.php";
require "../session.php";

if ($role !== 'admin') {
  header("location:../login.php");
};

$id = $_SESSION["id"];
$admin = query("SELECT * FROM admin WHERE id = '$id'")[0];

// Pagination
$jmlHalamanPerData = 5;
$jumlahData = count(query("SELECT * FROM pendaftar"));
$jmlHalaman = ceil($jumlahData / $jmlHalamanPerData);

if (isset($_GET["halaman"])) {
  $halamanAktif = $_GET["halaman"];
} else {
  $halamanAktif = 1;
}

$awalData = ($jmlHalamanPerData * $halamanAktif) - $jmlHalamanPerData;

$pendaftar = query("SELECT * FROM pendaftar LIMIT $awalData, $jmlHalamanPerData");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Admin</title>

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
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php">
        <div class="sidebar-brand-icon mt-4">
          <?php if (!empty($admin["foto"]) && file_exists('../assets/img/' . $admin["foto"])) : ?>
            <img src="../assets/img/<?= $admin["foto"]; ?>" style="width: 70px; height: 70px" class="rounded-circle" alt="">
          <?php else : ?>
            <img src="../assets/img/person_2.jpg" style="width: 70px; height: 70px" class="rounded-circle" alt="">
          <?php endif; ?>
          <div class="sidebar-brand-text mx-3"><?= $admin["nm_dpn"]; ?></div>
        </div>
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
        <a class="nav-link" href="pendaftar.php">
          <i class="fab fa-wpforms"></i>
          <span>Pendaftaran</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider my-0" />

      <!-- Nav Item - Dokumen -->
      <li class="nav-item">
        <a class="nav-link" href="user.php">
          <i class="fas fa-file-upload"></i>
          <span>Data Peserta</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider my-0" />

      <li class="nav-item">
        <a class="nav-link" href="admin.php">
          <i class="fas fa-file-upload"></i>
          <span>Data Admin</span></a>
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

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                <span class="mr-2 d-none d-lg-inline text-gray-600 "><?= $admin["adm_email"]; ?></span>
                <?php if (!empty($admin["foto"]) && file_exists('../assets/img/' . $admin["foto"])) : ?>
                  <img src="../assets/img/<?= $admin["foto"]; ?>" style="width: 50px; height: 50px" class="rounded-circle" alt="">
                <?php else : ?>
                  <img src="../assets/img/person_2.jpg" style="width: 50px; height: 50px" class="rounded-circle" alt="">
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
          <h1 class="h3 mb-4 text-gray-800">Data Pendaftaran</h1>
          <!-- DataTales Example -->
          <div class="card shadow">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Yang Sudah Mendaftar</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="s0">
                  <thead>
                    <tr>
                      <th>Nama</th>
                      <th>Gender</th>
                      <th>NPSN</th>
                      <th>Asal Sekolah</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($pendaftar as $row) : ?>
                      <tr>
                        <td><?= $row["nama"]; ?></td>
                        <td><?= $row["jk"]; ?></td>
                        <td><?= $row["npsn"]; ?></td>
                        <td><?= $row["asal_sekolah"]; ?></td>
                        <td>
                          <a href="detail.php?id=<?= $row["id_data"]; ?>" class="btn btn-primary">Detail</a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>

              <ul class="pagination">
                <?php if ($halamanAktif > 1) : ?>
                  <li class="page-item">
                    <a href="?halaman=<?= $halamanAktif - 1; ?>" class="page-link">Previous</a>
                  </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $jmlHalaman; $i++) : ?>
                  <?php if ($i == $halamanAktif) : ?>
                    <li class="page-item active"><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
                  <?php else : ?>
                    <li class="page-item "><a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a></li>
                  <?php endif; ?>
                <?php endfor; ?>

                <?php if ($halamanAktif < $jmlHalaman) : ?>
                  <li class="page-item">
                    <a href="?halaman=<?= $halamanAktif + 1; ?>" class="page-link">Next</a>
                  </li>
                <?php endif; ?>
              </ul>

            </div>
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
  <script src="../assets/js/sb-admin-2.min.js"></script>
  <script src="../assets/js/function.js"></script>
</body>

</html>