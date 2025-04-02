<?php
session_start();
if(!(isset($_SESSION['fullname']) && isset($_SESSION['time']))) {
  echo "
  <script>
  alert('Anda Belum Login!');
  window.location.href= 'index.php';
  </script>";
  exit();
} else {
  session_unset();
  session_destroy();
  header("Location:index.php");
}

?>