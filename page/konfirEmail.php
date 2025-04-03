<?php
include "../include/conn.php";
if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $cekquery = "SELECT * FROM reset_pass WHERE token='$token'";
    $exec = mysqli_query($conn, $cekquery);
    if(mysqli_num_rows($exec) == 1) {
        $getEmail = mysqli_fetch_assoc($exec);
        $email = $getEmail['email'];
    } else {
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
    <title>Email Terkirim</title>
    <link rel="stylesheet" href="../assets/konfirEmail.css">
</head>

<body>
    <div class="confirmation-container">
        <div class="icon-circle">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>

        <h1>Email Terkirim!</h1>

        <p class="confirmation-text">
            Kami telah mengirimkan link reset password ke <span class="email-highlight"><?= $email ?></span>.
            Silakan periksa inbox email Anda.
        </p>

        <div class="check-spam">
            <h3>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                Tidak menerima email?
            </h3>
            <p>
                Periksa folder spam atau junk mail Anda. Jika masih tidak menemukannya,
                tunggu beberapa menit atau coba kirim ulang email.
            </p>
        </div>

        <div class="back-to-login">
            <a href="index.php">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke halaman login
            </a>
        </div>
    </div>
</body>

</html>