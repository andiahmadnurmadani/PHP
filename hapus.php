<?php
include "conn.php";
$nim = $_GET['nim'];
$query = "DELETE FROM mahasiswa WHERE nim='$nim'";
mysqli_query($conn, $query);
if(mysqli_affected_rows($conn) > 0) {
  header("Location:index.php");
} else {
  echo "<script>alert('Data gagal di hapus')</script>";
  header("Location:index.php");
}

?>