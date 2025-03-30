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

        <form class="register-form" action="/register" method="POST">
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

            <button type="submit" class="submit-button">Daftar Sekarang</button>

            <div class="login-link">
                Sudah punya akun? <a href="index.php">Masuk disini</a>
            </div>
        </form>
    </div>
</body>
</html>