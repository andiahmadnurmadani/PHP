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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --black: #000000;
            --white: #ffffff;
            --gray: #f5f5f5;
            --shadow: 4px 4px 0px var(--black);
            --shadow-hover: 6px 6px 0px var(--black);
            --transition: all 0.2s ease;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--white);
            color: var(--black);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .confirmation-container {
            width: 100%;
            max-width: 500px;
            padding: 2rem;
            background-color: var(--white);
            border: 3px solid var(--black);
            box-shadow: var(--shadow);
            text-align: center;
            transition: var(--transition);
            margin: 2rem;
        }

        .confirmation-container:hover {
            box-shadow: var(--shadow-hover);
        }

        .icon-circle {
            width: 80px;
            height: 80px;
            border: 3px solid var(--black);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            box-shadow: var(--shadow);
        }

        .icon-circle svg {
            width: 40px;
            height: 40px;
            stroke: var(--black);
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 1rem;
            text-transform: uppercase;
        }

        .confirmation-text {
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .email-highlight {
            font-weight: 600;
            text-decoration: underline;
        }

        .check-spam {
            background-color: var(--gray);
            border: 2px solid var(--black);
            padding: 1rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
            text-align: left;
        }

        .check-spam h3 {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 0;
            font-size: 1.1rem;
        }

        .check-spam svg {
            width: 20px;
            height: 20px;
            stroke: var(--black);
        }

        .check-spam p {
            margin-bottom: 0;
            font-size: 0.9rem;
        }

        .back-to-login a {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background-color: var(--white);
            color: var(--black);
            border: 2px solid var(--black);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
            box-shadow: var(--shadow);
        }

        .back-to-login a:hover {
            box-shadow: var(--shadow-hover);
            transform: translate(-2px, -2px);
            background-color: var(--black);
            color: var(--white);
        }

        .back-to-login svg {
            width: 20px;
            height: 20px;
        }

        @media (max-width: 600px) {
            .confirmation-container {
                padding: 1.5rem;
                margin: 1rem;
            }
            
            h1 {
                font-size: 1.5rem;
            }
        }
    </style>
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
            Kami telah mengirimkan link reset password ke <span style="text-decoration: none;" class="email-highlight"><?= $email ?></span>.
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