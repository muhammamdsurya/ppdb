<?php
require "../../functions.php";

$id = $_GET['id'];

if (hapusAdmin($id) > 0) {
  echo "<script>
  alert('Berhasil Dihapus');
  document.location.href = '../admin.php';
  </script>";
} else {
  echo "<script>
  alert('Berhasil Dihapus');
  document.location.href = '../admin.php';
  </script>";
}
