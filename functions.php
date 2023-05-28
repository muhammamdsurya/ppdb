<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', '/path/to/error.log');

$conn = mysqli_connect("localhost", "root", "", "ppdb1");
if (!$conn) {
  error_log("Koneksi database gagal: " . mysqli_connect_error());
}

function query($query)
{
  global $conn;

  $result = mysqli_query($conn, $query);
  $rows = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }
  return $rows;
}

function hapusUser($data)
{
  global $conn;

  mysqli_query($conn, "DELETE FROM user where userid = '$data'");
  return mysqli_affected_rows($conn);
}

function hapusAdmin($data)
{
  global $conn;

  mysqli_query($conn, "DELETE FROM admin where id = '$data'");
  return mysqli_affected_rows($conn);
}

function hapusDetail($data)
{
  global $conn;

  mysqli_query($conn, "DELETE p.*, d.* FROM pendaftar p LEFT JOIN doc d ON p.userid = d.userid WHERE p.id_data = '$data'");
  return mysqli_affected_rows($conn);
}


function editUser($data)
{
  global $conn;

  $id = $_SESSION["id"];
  $nm_dpn = $data["nm_dpn"];
  $nm_blkg = $data["nm_blkg"];
  $email = $data["email"];
  $fotoLama = $data["fotoLama"];

  if ($_FILES["foto"]["error"] === 4) {
    $foto = $fotoLama;
  } else {
    $foto = upload('foto');
  }


  $query = "UPDATE user SET nm_dpn = '$nm_dpn', nm_blkg = '$nm_blkg', user_email = '$email', foto = '$foto' WHERE userid = '$id'";

  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function editAdm($data)
{
  global $conn;

  $id = $_SESSION["id"];
  $nm_dpn = $data["nm_dpn"];
  $nm_blkg = $data["nm_blkg"];
  $email = $data["email"];
  $fotoLama = $data["fotoLama"];

  if ($_FILES["foto"]['error'] === 4) {
    $foto = $fotoLama;
  } else {
    $foto = upload('foto');
  }

  $query = "UPDATE admin SET nm_dpn = '$nm_dpn', nm_blkg = '$nm_blkg', adm_email = '$email', foto = '$foto' WHERE id = '$id'";

  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function tambahAdm($data)
{
  global $conn;

  $nm_dpn = $data["nm_dpn"];
  $nm_blkg = $data["nm_blkg"];
  $email = $data["email"];
  $password = $data["password"];
  $foto = upload("foto");

  if (!upload("foto")) {
    return false;
  }

  $query = "INSERT INTO admin (nm_dpn, nm_blkg, adm_email, password, foto) VALUES ('$nm_dpn','$nm_blkg','$email','$password','$foto')";

  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function formDaftar($data)
{
  global $conn;

  $id = $_SESSION["id"];
  $nama = $data["nama"];
  $jk = $data["jk"];
  $tmp_lahir = $data["tmp_lahir"];
  $tgl_lahir = $data["tgl_lahir"];
  $npsn = $data["npsn"];
  $agama = $data["agama"];
  $asal_sekolah = $data["asal_sekolah"];
  $alamat = $data["alamat"];
  $foto = upload("fotoForm");
  if (!upload("fotoForm")) {
    return false;
  }


  $query = "INSERT INTO pendaftar (userid, nama, jk, tmp_lahir, tgl_lahir, npsn, agama,asal_sekolah, alamat, foto) VALUES ('$id','$nama','$jk', '$tmp_lahir','$tgl_lahir','$npsn','$agama','$asal_sekolah','$alamat','$foto')";
  mysqli_query($conn, $query);
  return mysqli_affected_rows($conn);
}

function cek()
{
  global $conn;

  $id = $_SESSION["id"];
  $query = mysqli_query($conn, "SELECT COUNT(*) FROM pendaftar WHERE userid = '$id'");
  $result = mysqli_fetch_row($query);
  $count = $result[0];

  if ($count > 0) {
    return true; // Form sudah diisi
  } else {
    return false; // Form belum diisi
  }
}

function upload($formName)
{
  $namaFile = $_FILES[$formName]['name'];
  $ukuranFile = $_FILES[$formName]['size'];
  $error = $_FILES[$formName]['error'];
  $tmpName = $_FILES[$formName]['tmp_name'];

  // Cek apakah gambar
  $extensiValid = ['jpg', 'png', 'jpeg'];
  $extensiGambar = explode('.', $namaFile);
  $extensiGambar = strtolower(end($extensiGambar));

  if (!in_array($extensiGambar, $extensiValid)) {
    echo "<script>
    alert('Yang anda upload bukan gambar!');
    </script>";
    return false;
  }

  if ($ukuranFile > 1000000) {
    echo "<script>
    alert('Ukuran Gambar Terlalu Besar!');
    </script>";
    return false;
  }

  $namaFileBaru = uniqid();
  $namaFileBaru .= '.';
  $namaFileBaru .= $extensiGambar;
  // Move File
  move_uploaded_file($tmpName, '../assets/img/' . $namaFileBaru);
  return $namaFileBaru;
}

function daftar($data)
{
  global $conn;

  $nm_dpn = $data["nm_dpn"];
  $nm_blkg = $data["nm_blkg"];
  $email = $data["email"];
  $password = $data["password"];

  $cek = mysqli_query($conn, "SELECT user_email FROM user WHERE user_email = '$email'");

  if (mysqli_fetch_assoc($cek)) {
    echo "<div class='alert alert-danger'>Username telah terdaftar</div>
          <meta http-equiv='refresh' content='2; url=''/>  ";
    return false;
  }

  $query = "INSERT INTO user (nm_dpn, nm_blkg, user_email, password) VALUES ('$nm_dpn', '$nm_blkg', '$email', '$password')";

  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}

function konfirmasi($id)
{

  global $conn;
  $query = "UPDATE pendaftar SET status = 'Terkonfirmasi' WHERE id_data = '$id'";

  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);
}
