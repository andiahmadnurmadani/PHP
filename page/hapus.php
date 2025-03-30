<?php
include "../include/conn.php";
$nim = $_GET['nim'];
$query = "DELETE FROM mahasiswa WHERE nim='$nim'";
mysqli_query($conn, $query);
if(mysqli_affected_rows($conn) > 0) {
  header("Location:data.php");
} else {
  echo "<script>alert('Data gagal di hapus')</script>";
  header("Location:data.php");
}

?>