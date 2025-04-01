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

      <button type="submit" class="login-button">Masuk</button>

      <div class="register-link">
        Belum punya akun? <a href="register.php">Daftar disini</a>
      </div>
    </form>
  </div>
</body>

</html>