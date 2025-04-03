<?php
include "../include/conn.php";

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $querycek = "SELECT * FROM reset_pass WHERE token='$token'";
    $exec = mysqli_query($conn, $querycek);
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
    <link rel="stylesheet" href="../assets/passBaru.css">
</head>

<body>
    <div class="password-container">
        <h1>Buat Password Baru</h1>
        <p class="subtitle">Masukkan dan konfirmasi password baru Anda</p>

        <form>
            <div class="input-box">
                <label for="new-password">Password Baru</label>
                <input type="password" id="new-password" placeholder="Minimal 8 karakter">
                <span class="toggle-password" onclick="togglePassword()">Lihat</span>
            </div>

            <div class="input-box">
                <label for="confirm-password">Konfirmasi Password</label>
                <input type="password" id="confirm-password" placeholder="Ketik ulang password">
            </div>

            <button type="submit" class="submit-btn">Simpan Password</button>
        </form>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('new-password');
            const toggleText = document.querySelector('.toggle-password');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleText.textContent = 'Sembunyikan';
            } else {
                passwordInput.type = 'password';
                toggleText.textContent = 'Lihat';
            }
        }
    </script>
</body>

</html>