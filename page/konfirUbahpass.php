<?php
include "../include/conn.php";
if (isset($_GET['token'])) {
  $token = $_GET['token'];
  $cekquery = "SELECT * FROM reset_pass WHERE token='$token'";
  $exec = mysqli_query($conn, $cekquery);
  if (mysqli_num_rows($exec) == 1) {
    $getEmail = mysqli_fetch_assoc($exec);
    $email = $getEmail['email'];
  } else {
    echo "
        <script>
        alert('Token tidak valid!')
        window.location.href='lupaPass.php'
        </script>";
  }
} else {
  echo "
    <script>
    alert('Akses tidak valid!')
    window.location.href='lupaPass.php'
    </script>";
}

$hapusToken = "DELETE FROM reset_pass WHERE token='$token'";
mysqli_query($conn, $hapusToken);

?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Password Berhasil Diubah</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../assets/konfirUbahpass.css">
</head>

<body>
  <div class="confirmation-container">
    <div class="icon-circle">
      <i class="fas fa-check-circle"></i>
    </div>

    <h1>Password Berhasil Diubah!</h1>

    <div class="confirmation-text">
      Password untuk akun <strong><?= $email ?></strong> telah berhasil diperbarui.<br>
      Anda sekarang bisa masuk menggunakan password baru Anda.
    </div>

    <div class="security-tips">
      <h3>
        <i class="fas fa-shield-alt"></i> Tips Keamanan Akun
      </h3>
      <ul>
        <li>Jangan bagikan password Anda dengan siapapun</li>
        <li>Gunakan password yang unik dan kuat</li>
        <li>Perbarui password secara berkala</li>
        <li>Aktifkan verifikasi dua langkah jika tersedia</li>
      </ul>
    </div>

    <div class="back-to-login">
      <a href="index.php">
        <i class="fas fa-sign-in-alt"></i> Masuk Sekarang
      </a>
    </div>
  </div>
</body>

</html>

