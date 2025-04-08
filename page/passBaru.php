<?php
include "../include/conn.php";
$email;
if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $querycek = "SELECT * FROM reset_pass WHERE token='$token'";
    $exec = mysqli_query($conn, $querycek);
    $getEmail = mysqli_fetch_assoc($exec);
    $email = $getEmail['email'];
    if (mysqli_num_rows($exec) == 0) {
        echo "
    <script>
    alert('Anda Hengker?')
    window.location.href='lupaPass.php'
    </script>";
    }
} else {
    echo "
    <script>
    alert('Anda Hengker?')
    window.location.href='lupaPass.php'
    </script>";
}

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Baru</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/passBaru.css">
</head>

<body>
    <div class="password-container">
        <h1>Buat Password Baru</h1>
        <p class="subtitle">Masukkan dan konfirmasi password baru Anda</p>

        <form method="POST" action="">
            <input type="hidden" name="email" value="<?= $email ?>">
            <input type="hidden" name="token" value="<?= $token ?>">

            <div class="input-box">
                <label for="new-password">Password Baru</label>
                <input type="password" id="new-password" name="new_password" placeholder="Minimal 8 karakter" required>
                <span class="toggle-password" onclick="togglePassword()">
                    <i class="fas fa-eye"></i> Lihat
                </span>
            </div>

            <div class="input-box">
                <label for="confirm-password">Konfirmasi Password</label>
                <input type="password" id="confirm-password" name="confirm_password" placeholder="Ketik ulang password" required>
            </div>

            <button type="submit" class="submit-btn" name="submit">
                <i class="fas fa-save"></i> Simpan Password
            </button>
        </form>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('new-password');
            const toggleIcon = document.querySelector('.toggle-password i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.replace('fa-eye', 'fa-eye-slash');
                document.querySelector('.toggle-password').innerHTML = '<i class="fas fa-eye-slash"></i> Sembunyikan';
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.replace('fa-eye-slash', 'fa-eye');
                document.querySelector('.toggle-password').innerHTML = '<i class="fas fa-eye"></i> Lihat';
            }
        }
    </script>
</body>

</html>

<?php
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $token = $_POST['token'];
    $password = $_POST['new_password'];
    $konfirpass = $_POST['confirm_password'];

    if ($password == $konfirpass && strlen($password) >= 8 && strlen($password) <= 16) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE pengguna SET password='$hash' WHERE email='$email'";
        mysqli_query($conn, $query);
    } else {
        echo "<script>alert('Password tidak sesuai')</script>";
    }

    if (mysqli_affected_rows($conn) > 0) {
        header("Location:konfirUbahpass.php?token=$token");
    } else {
        echo "<script>alert('Password gagal diubah')</script>";
    }
}

?>