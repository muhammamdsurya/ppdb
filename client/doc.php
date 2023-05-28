<?php
session_start();
require "../functions.php";
require "../session.php";

if ($role !== "user") {
  header("Location: ../login.php");
}

$id = $_SESSION["id"];

$user = query("SELECT * FROM user WHERE userid = '$id'")[0];
if (isset($_POST['upload'])) {

  $namaFileIjazah = upload('ijazah');
  $namaFileKK = upload('kk');
  $namaFileRapor = upload('rapor');
  $namaFileAkta = upload('akta');

  var_dump($namaFileIjazah);
  var_dump($namaFileAkta);


  // Menyimpan nama file ke dalam kolom yang berbeda dalam tabel database
  $sql = "INSERT INTO doc (userid, ijazah, kk, rapor, akta)
          VALUES ('$id','$namaFileIjazah', '$namaFileKK', '$namaFileRapor', '$namaFileAkta')";

  if ($conn->query($sql) === TRUE) {
    echo "<div class='alert alert-success'>Berhasil Upload!</div>
            <meta http-equiv='refresh' content='2; url= doc.php'/>  ";
  } else {
    echo "<div class='alert alert-success'>Gagal Upload!</div>
            <meta http-equiv='refresh' content='2; url= doc.php'/>  ";
  }
}

$doc = query("SELECT * FROM doc WHERE userid = '$id'");




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

</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php">
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
        <a class="nav-link" href="doc.php">
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

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 "><?= $_SESSION["email"]; ?></span>

                <?php if (!empty($user["foto"]) && file_exists('../assets/img/' . $user["foto"])) : ?>
                  <img src="../assets/img/<?= $user["foto"]; ?>" style="width: 50px; height : 50px" class="rounded-circle" alt="">
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
          <h1 class="h3 mb-4 text-gray-800">Dokumen</h1>

          <div class="row">

            <div class="col-md-7">

              <form class="shadow p-3" method="POST" enctype="multipart/form-data">
                <h1 class="h3 mb-4 text-gray-800 text-center">Upload</h1>
                <div class="col-md-12 mb-3">
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Ijazah</label>
                    <?php if (empty($doc[0]["ijazah"])) : ?>
                      <input type="file" name="ijazah" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    <?php else : ?>
                      <div class="alert alert-success" role="alert">
                        Kamu Sudah Upload! Klik tombol preview untuk cek
                      </div>
                    <?php endif; ?>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Kartu Keluarga</label>
                    <?php if (empty($doc[0]["kk"])) : ?>
                      <input type="file" name="kk" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    <?php else : ?>
                      <div class="alert alert-success" role="alert">
                        Kamu Sudah Upload! Klik tombol preview untuk cek
                      </div>
                    <?php endif; ?>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Raport</label>
                    <?php if (empty($doc[0]["ijazah"])) : ?>
                      <input type="file" name="rapor" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    <?php else : ?>
                      <div class="alert alert-success" role="alert">
                        Kamu Sudah Upload! Klik tombol preview untuk cek
                      </div>
                    <?php endif; ?>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Akta Kelahiran</label>
                    <?php if (empty($doc[0]["ijazah"])) : ?>
                      <input type="file" name="akta" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    <?php else : ?>
                      <div class="alert alert-success" role="alert">
                        Kamu Sudah Upload! Klik tombol preview untuk cek
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="row mt-2">
                  <div class="col text-center">
                    <?php if (empty($doc[0]["ijazah"]) || empty($doc[0]["kk"]) || empty($doc[0]["rapor"]) || empty($doc[0]["akta"])) : ?>
                      <button type="submit" name="upload" class="btn btn-primary btn-lg px-5">Upload</button>
                    <?php else : ?>

                    <?php endif; ?>
                  </div>
                </div>
              </form>

            </div>

            <div class="col-md-5 mt-4 p-3">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Preview</h6>
                </div>
                <div class="card-body">
                  <div class="row align-items-center my-3">
                    <div class="col">
                      <label for="exampleInputEmail1" class="form-label">Ijazah</label>
                    </div>
                    <div class="col">
                      <?php if (empty($doc[0]["ijazah"])) : ?>
                        <div class="alert alert-warning" role="alert">
                          Kamu Belum Upload
                        </div>
                      <?php else : ?>
                        <button type="button" class="btn btn-warning preview-button" data-target="image-preview" data-image="../assets/img/<?= $doc[0]["ijazah"]; ?>">Preview</button>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="row align-items-center my-3">
                    <div class="col">
                      <label for="exampleInputEmail1" class="form-label">Kartu Keluarga</label>
                    </div>
                    <div class="col">
                      <?php if (empty($doc[0]["kk"])) : ?>
                        <div class="alert alert-warning" role="alert">
                          Kamu Belum Upload
                        </div>
                      <?php else : ?>
                        <button type="button" class="btn btn-warning preview-button" data-target="image-preview" data-image="../assets/img/<?= $doc[0]["kk"]; ?>">Preview</button>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="row align-items-center my-3">
                    <div class="col">
                      <label for="exampleInputEmail1" class="form-label">Rapor</label>
                    </div>
                    <div class="col">
                      <?php if (empty($doc[0]["rapor"])) : ?>
                        <div class="alert alert-warning" role="alert">
                          Kamu Belum Upload
                        </div>
                      <?php else : ?>
                        <button type="button" class="btn btn-warning preview-button" data-target="image-preview" data-image="../assets/img/<?= $doc[0]["rapor"]; ?>">Preview</button>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="row align-items-center my-3">
                    <div class="col">
                      <label for="exampleInputEmail1" class="form-label">Akta</label>
                    </div>
                    <div class="col">
                      <?php if (empty($doc[0]["akta"])) : ?>
                        <div class="alert alert-warning" role="alert">
                          Kamu Belum Upload
                        </div>
                      <?php else : ?>
                        <button type="button" class="btn btn-warning preview-button" data-target="image-preview" data-image="../assets/img/<?= $doc[0]["akta"]; ?>">Preview</button>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
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
  <script src="../assets/js/sb-admin-2.js"></script>
  <script src="../assets/js/function.js"></script>
</body>
</body>

</html>