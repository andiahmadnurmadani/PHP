<?php
include "../include/conn.php";
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Halaman Login</title>
  <link rel="stylesheet" href="../assets/index.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>

<body>
  <div class="login-container">
    <div class="login-header">
      <h1>Selamat Datang</h1>
      <p>Silakan masuk ke akun Anda</p>
    </div>

    <form class="login-form" action="" method="POST">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Masukkan username" required>
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Masukkan password" required>
      </div>

      <div class="form-options">
        <label>
          <input type="checkbox" name="remember"> Ingat saya
        </label>
        <a href="#">Lupa password?</a>
      </div>

      <button type="submit" class="login-button" name="login">Masuk</button>

      <div class="register-link">
        Belum punya akun? <a href="register.php">Daftar disini</a>
      </div>
    </form>
  </div>
</body>

</html>

<?php
if(isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $cek = mysqli_query($conn, "SELECT * FROM pengguna WHERE username='$username' AND password ='$password'");

  if(mysqli_num_rows($cek) == 1) {
    echo "
    <script>
    alert('Berhasil Login')
    window.location.href='data.php';
    </script>";
  } else {
    echo "
    <script>
    alert('Username atau password salah!')
    </script>";
  }
}
?>