<?php
session_start();
require "../functions.php";
require "../session.php";

if ($role !== 'admin') {
  header("location:../login.php");
};

$id = $_GET['id'];
$idAdmin = $_SESSION["id"];
$admin = query("SELECT * FROM admin WHERE id = '$idAdmin'")[0];

$query = "SELECT p.*, d.* FROM pendaftar p LEFT JOIN doc d ON p.userid = d.userid WHERE p.id_data = '$id'";
$result = query($query);
$detail = $result[0];

if (isset($_POST["konfirmasi"])) {
  if (konfirmasi($_POST["id_data"]) > 0) {
    echo "<div class='alert alert-success'>Berhasil Konfirmasi</div>
            <meta http-equiv='refresh' content='2; url= pendaftar.php'/>  ";
  } else {
    echo "<div class='alert alert-success'>Gagal Konfirmasi</div>
            <meta http-equiv='refresh' content='2; url= pendaftar.php'/>  ";
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

  <title>Admin</title>

  <!-- Custom fonts for this template-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

  <!-- Custom styles for this template-->
  <link href="../assets/css/sb-admin-2.css" rel="stylesheet" />

  <style>
    .form-check-input:disabled+.form-check-label {
      color: black;
      cursor: not-allowed;
    }
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
          <h1 class="h3 mb-4 text-gray-800">Detail Pendaftaran</h1>

          <form class="shadow p-3" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_data" value="<?= $detail["id_data"]; ?>">
            <div class="row">
              <img src="../assets/img/<?= $detail["foto"]; ?>" style="width:300px; height: 300px; aspect-ratio: 3/2; object-fit: contain; " class="mx-auto my-3" alt="">
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $detail["nama"]; ?>" disabled>
                  </div>
                  <p>Jenis Kelamin : </p>
                  <div class="mb-3 d-flex">
                    <div class="form-check mx-3">
                      <input class="form-check-input" type="radio" name="gender" id="male" value="Laki-Laki" <?php if ($detail["jk"] == "Laki-Laki") echo "checked"; ?> disabled>
                      <label class="form-check-label" for="male">
                        Laki-Laki
                      </label>
                    </div>
                    <div class="form-check mx-3">
                      <input class="form-check-input" type="radio" name="gender" id="female" value="Perempuan" <?php if ($detail["jk"] == "Perempuan") echo "checked"; ?> disabled>
                      <label class="form-check-label" for="female">
                        Perempuan
                      </label>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tempat Lahir</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $detail["tmp_lahir"]; ?>" disabled>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $detail["tgl_lahir"]; ?>" disabled>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">NPSN</label>
                    <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $detail["npsn"]; ?>" disabled>
                  </div>
                  <div class="form-group mb-3">
                    <label for="agama" class="form-label">Agama</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $detail["agama"]; ?>" disabled>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Asal Sekolah</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $detail["asal_sekolah"]; ?>" disabled>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Alamat</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $detail["alamat"]; ?>" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3 d-flex align-items-center flex-column">
                    <label for="exampleInputEmail1" class="form-label">Ijazah</label>
                    <?php if (empty($detail["ijazah"])) : ?>
                      <div class="alert alert-danger">Belum Upload!</div>
                    <?php else : ?>
                      <img src="../assets/img/<?= $detail["ijazah"]; ?>" style="width:300px; height:300px; aspect-ratio: 3/2; object-fit:contain" alt="">
                    <?php endif; ?>
                    <button type="button" class="btn btn-warning preview-button" data-target="image-preview" data-image="../assets/img/<?= $detail["ijazah"]; ?>">Preview</button>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3 d-flex align-items-center flex-column">
                    <label for="exampleInputEmail1" class="form-label">Kartu Keluarga</label>
                    <?php if (empty($detail["kk"])) : ?>
                      <div class="alert alert-danger">Belum Upload!</div>
                    <?php else : ?>
                      <img src="../assets/img/<?= $detail["kk"]; ?>" style="width:300px; height:300px; aspect-ratio: 3/2; object-fit:contain" alt="">
                    <?php endif; ?>
                    <button type="button" class="btn btn-warning preview-button" data-target="image-preview" data-image="../assets/img/<?= $detail["kk"]; ?>">Preview</button>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3 d-flex align-items-center flex-column">
                    <label for="exampleInputEmail1" class="form-label">Akta Kelahiran</label>
                    <?php if (empty($detail["akta"])) : ?>
                      <div class="alert alert-danger">Belum Upload!</div>
                    <?php else : ?>
                      <img src="../assets/img/<?= $detail["akta"]; ?>" style="width:300px; height:300px; aspect-ratio: 3/2; object-fit:contain" alt="">
                    <?php endif; ?>
                    <button type="button" class="btn btn-warning preview-button" data-target="image-preview" data-image="../assets/img/<?= $detail["akta"]; ?>">Preview</button>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="mb-3 d-flex align-items-center flex-column">
                    <label for="exampleInputEmail1" class="form-label">Raport</label>
                    <?php if (empty($detail["rapor"])) : ?>
                      <div class="alert alert-danger">Belum Upload!</div>
                    <?php else : ?>
                      <img src="../assets/img/<?= $detail["rapor"]; ?>" style="width:300px; height:300px; aspect-ratio: 3/2; object-fit:contain" alt="">
                    <?php endif; ?>
                    <button type="button" class="btn btn-warning preview-button" data-target="image-preview" data-image="../assets/img/<?= $detail["rapor"]; ?>">Preview</button>
                  </div>
                </div>
              </div>
              <div class="col ">
                <?php if ($detail["status"] == "Terkonfirmasi") : ?>
                  <button type="button" class="btn btn-primary btn-lg px-5" disabled>Terkonfirmasi</button>
                <?php else : ?>
                  <button name="konfirmasi" type="submit" class="btn btn-primary btn-lg px-5">Konfirmasi</button>
                <?php endif; ?>
                <a href="controller/hapusDetail.php?id=<?= $detail["id_data"]; ?>" class="btn btn-danger btn-lg px-5" onclick="return confirm('Yakin ingin Menghapus?')">Hapus</a>
              </div>
            </div>
          </form>

        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer ">
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