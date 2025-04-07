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
  <link rel="stylesheet" href="../assets/lupaPass.css">
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
  $query = "SELECT * FROM user WHERE email='$email'";
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
    $mail->Subject = $subject;
    $mail->Body    = $msg;

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