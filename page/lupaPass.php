<?php
include "../include/conn.php";

use PHPMailer\PHPMailer\PHPMailer;

//Load Composer's autoloader (created by composer, not included with PHPMailer)
require '../vendor/autoload.php';
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lupa Password</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
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

    .container {
      width: 100%;
      max-width: 500px;
      padding: 2rem;
      background-color: var(--white);
      border: 3px solid var(--black);
      box-shadow: var(--shadow);
      transition: var(--transition);
      margin: 2rem;
      text-align: center;
    }

    .container:hover {
      box-shadow: var(--shadow-hover);
    }

    h1 {
      font-size: 2rem;
      margin-bottom: 0.5rem;
      font-weight: 600;
    }

    .subtitle {
      margin-bottom: 2rem;
      color: var(--black);
    }

    #forgotPasswordForm {
      display: flex;
      flex-direction: column;
      gap: 1.5rem;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
      text-align: left;
    }

    .form-group label {
      font-weight: 500;
      font-size: 0.9rem;
    }

    .form-group input {
      padding: 0.8rem 1rem;
      border: 2px solid var(--black);
      background-color: var(--white);
      font-family: inherit;
      font-size: 1rem;
      transition: var(--transition);
      box-shadow: var(--shadow);
    }

    .form-group input:focus {
      outline: none;
      box-shadow: var(--shadow-hover);
      transform: translate(-2px, -2px);
    }

    .form-group input:hover {
      box-shadow: var(--shadow-hover);
      transform: translate(-2px, -2px);
    }

    .divider {
      height: 2px;
      background-color: var(--black);
      margin: 1rem 0;
    }

    .btn {
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
      width: 100%;
    }

    .btn:hover {
      background-color: var(--black);
      color: var(--white);
      box-shadow: var(--shadow-hover);
      transform: translate(-2px, -2px);
    }

    .login-link {
      text-align: center;
      font-size: 0.9rem;
      margin-top: 1.5rem;
    }

    .login-link a {
      color: var(--black);
      text-decoration: underline;
      font-weight: 500;
      transition: var(--transition);
    }

    .login-link a:hover {
      text-decoration: none;
    }

    @media (max-width: 600px) {
      .container {
        margin: 1rem;
        padding: 1.5rem;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>Lupa Password?</h1>
    <p class="subtitle">Masukkan email Anda untuk mereset password</p>

    <form id="forgotPasswordForm" method="POST" action="">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Masukkan email" required>
      </div>

      <div class="divider"></div>

      <button type="submit" name="submit" class="btn">Kirim Link Reset</button>
    </form>

    <div class="login-link">
      Ingat password? <a href="index.php">Masuk disini</a>
    </div>
  </div>
</body>

</html>
<?php
if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $query = "SELECT * FROM pengguna WHERE email='$email'";
  $result = mysqli_query($conn, $query);
  $cek = mysqli_fetch_assoc($result);

  if ($cek) {
    $nama = $cek['nama'];
    $username = $cek['username'];

    $token = bin2hex(random_bytes(50));

    $queryToken = "INSERT INTO reset_pass (email,token) VALUES ('$email', '$token')";

    $link = "http://localhost/Latihan_CRUD_php/page/passbaru.php?token=" . $token;
    $subject = "Reset Password Anda";
    $msg = "Hallo, $nama <br> Kami menerima permintaan reset password untuk akun Anda. Dengan username : <h2>$username</h2> Klik tombol berikut untuk melanjutkan: 
    <a href='$link' class='button'>Reset Password</a> Atau salin link ini ke browser Anda:<br>
    <small>$link</small></p>";

    $mail = new PHPMailer(true);

    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'andibusines87@gmail.com';                     //SMTP username
    $mail->Password   = 'bysv kdal nxsm tkez';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('andibusines87@gmail.com', 'NMD');
    $mail->addAddress($email, $nama);     //Add a recipient
    $mail->addReplyTo('andibusines87@gmail.com', 'NMD');
    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "Permintaan Reset Password Akun Anda - NMD";
    date_default_timezone_set('Asia/Jakarta');
    $waktu = date('d F Y H:i');
    $mail->Body    = "<p>Halo <strong>$nama</strong>,</p>

<p>Kami menerima permintaan reset password untuk akun Anda dengan detail berikut:</p>

<table style='border-collapse: collapse; margin: 15px 0;'>
  <tr>
    <td style='padding: 5px 10px; border: 1px solid #ddd; background-color: #f9f9f9;'><strong>Username</strong></td>
    <td style='padding: 5px 10px; border: 1px solid #ddd;'>$username</td>
  </tr>
  <tr>
    <td style='padding: 5px 10px; border: 1px solid #ddd; background-color: #f9f9f9;'><strong>Waktu Permintaan</strong></td>
    <td style='padding: 5px 10px; border: 1px solid #ddd;'> $waktu WIB </td>
  </tr>
</table>

<p>Untuk melanjutkan proses reset password, silakan klik tombol berikut:</p>

<p style='margin: 25px 0;'>
  <a href='$link' style='background-color: #2563eb; color: white; padding: 12px 24px; text-decoration: none; border-radius: 4px; font-weight: bold; display: inline-block;'>Reset Password Saya</a>
</p>

<p>Atau salin dan tempel link berikut ke browser Anda:<br>
<small style='color: #666; word-break: break-all;'>$link</small></p>

<p style='color: #666; font-size: 0.9em; border-top: 1px solid #eee; padding-top: 15px; margin-top: 20px;'>
  <strong>Catatan Penting:</strong><br>
  - Link ini akan kadaluarsa dalam 5 Menit<br>
  - Jika Anda tidak meminta reset password, abaikan email ini<br>
  - Untuk keamanan, jangan bagikan link ini kepada siapapun
</p>

<p>Salam,<br>
<strong>NMD</p>";

    if ($mail->send()) {
      mysqli_query($conn, $queryToken);
      header("Location:konfirEmail.php?token=$token");
    } else {
      echo "
      <script>
      alert('gagal')
      </script>";
    }
  } else {
    echo "
    <script>
    alert('Email tidak terdaftar')
    </script>";
  }
}
?>