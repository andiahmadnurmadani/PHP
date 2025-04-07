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
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --black: #000000;
            --white: #ffffff;
            --gray: #f5f5f5;
            --dark-gray: #e0e0e0;
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

        .password-container {
            width: 100%;
            max-width: 500px;
            padding: 2rem;
            background-color: var(--white);
            border: 3px solid var(--black);
            box-shadow: var(--shadow);
            transition: var(--transition);
            margin: 2rem;
        }

        .password-container:hover {
            box-shadow: var(--shadow-hover);
        }

        h1 {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
        }

        .subtitle {
            text-align: center;
            margin-bottom: 2rem;
            color: var(--black);
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .input-box {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            position: relative;
        }

        .input-box label {
            font-weight: 500;
            font-size: 0.9rem;
        }

        .input-box input {
            padding: 0.8rem 1rem;
            border: 2px solid var(--black);
            background-color: var(--white);
            font-family: inherit;
            font-size: 1rem;
            transition: var(--transition);
            box-shadow: var(--shadow);
            padding-right: 3rem;
        }

        .input-box input:focus {
            outline: none;
            box-shadow: var(--shadow-hover);
            transform: translate(-2px, -2px);
        }

        .input-box input:hover {
            box-shadow: var(--shadow-hover);
            transform: translate(-2px, -2px);
        }

        .toggle-password {
            position: absolute;
            right: 1rem;
            top: 2.8rem;
            cursor: pointer;
            font-size: 0.9rem;
            color: var(--black);
            font-weight: 500;
            transition: var(--transition);
        }

        .toggle-password:hover {
            text-decoration: underline;
        }

        .submit-btn {
            padding: 0.8rem;
            background-color: var(--white);
            color: var(--black);
            border: 2px solid var(--black);
            font-family: inherit;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            box-shadow: var(--shadow);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 1rem;
        }

        .submit-btn:hover {
            background-color: var(--black);
            color: var(--white);
            box-shadow: var(--shadow-hover);
            transform: translate(-2px, -2px);
        }

        @media (max-width: 600px) {
            .password-container {
                margin: 1rem;
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="password-container">
        <h1>Buat Password Baru</h1>
        <p class="subtitle">Masukkan dan konfirmasi password baru Anda</p>

        <form method="POST" action="process_reset.php">
            <input type="hidden" name="token" value="<?= $_GET['token'] ?>">
            
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

            <button type="submit" class="submit-btn">
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