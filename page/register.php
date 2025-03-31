<?php
include "../include/conn.php";
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Akun Baru</title>
  <link rel="stylesheet" href="../assets/register.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <style>

  </style>
</head>

<body>
  <div class="register-container">
    <div class="register-header">
      <h1>Buat Akun Baru</h1>
      <p>Isi form berikut untuk mendaftar</p>
    </div>

    <form class="register-form" action="" method="POST">
      <div class="form-group">
        <label for="fullname">Nama Lengkap</label>
        <input type="text" id="fullname" name="fullname" placeholder="Masukkan nama lengkap Anda" required>
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="contoh@email.com" required>
      </div>

      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Buat username unik" required>
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Minimal 8 karakter" required>
        <small class="password-hint">Gunakan kombinasi huruf, angka, dan simbol</small>
      </div>

      <div class="form-group">
        <label for="confirm-password">Konfirmasi Password</label>
        <input type="password" id="confirm-password" name="confirm-password" placeholder="Ketik ulang password Anda" required>
      </div>

      <div class="terms-container">
        <label class="terms-checkbox">
          <input type="checkbox" name="agree-terms" required>
          <span class="checkmark"></span>
          Saya menyetujui
          <a href="#" class="terms-link">Syarat dan Ketentuan</a>

          <a href="#" class="terms-link">Kebijakan Privasi</a>
        </label>
      </div>

      <button type="submit" class="submit-button" name="submit">Daftar Sekarang</button>

      <div class="login-link">
        Sudah punya akun? <a href="index.php">Masuk disini</a>
      </div>
    </form>
  </div>
</body>

</html>

<?php
if (isset($_POST['submit'])) {
  $namalengkap = $_POST['fullname'];
  $email = $_POST['email'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $konfirpass = $_POST['confirm-password'];
  $setuju = isset($_POST['agree-terms']) ? 1 : 0;
  if (!$setuju) {
    echo "<script>alert('Anda harus menyetujui syarat dan ketentuan!')</script>";
    exit();
  }

  if(strlen($username) > 16) {
    echo "<script>alert('username tidak boleh lebih dari 16 karakter')</script>";
    exit();
  }

  $cek = mysqli_query($conn, "SELECT * FROM pengguna WHERE username='$username'");

  if (mysqli_num_rows($cek) > 0) {
    echo "<script>alert('Username Sudah Terdaftar')</script>";
    exit();
  }

  if ($password == $konfirpass) {
    $query = "INSERT INTO pengguna (username, password, name, email) VALUES ('$username', '$password', '$namalengkap', '$email')";
    mysqli_query($conn, $query);
  } else {
    echo "<script>alert('Password tidak sesuai')</script>";
  }

  if (mysqli_affected_rows($conn) > 0) {
    echo "<script>alert('Data Berhasil ditambahkan')</script>";
    header("Location:index.php");
  }
}
?>