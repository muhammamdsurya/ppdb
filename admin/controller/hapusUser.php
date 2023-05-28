<?php
require "../../functions.php";

$id = $_GET['id'];

if (hapusUser($id) > 0) {
  echo "<script>
  alert('Berhasil Dihapus');
  document.location.href = '../user.php';
  </script>";
} else {
  echo "<script>
  alert('Berhasil Dihapus');
  document.location.href = '../user.php';
  </script>";
}
