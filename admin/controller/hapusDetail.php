<?php
require "../../functions.php";

$id = $_GET["id"];

if (hapusDetail($id) > 0) {
    echo "<script>
  alert('Berhasil Dihapus');
  document.location.href = '../pendaftar.php';
  </script>";
} else {
    echo "<script>
  alert('Berhasil Dihapus');
  document.location.href = '../pendaftar.php';
  </script>";
}
