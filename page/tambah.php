<?php
include "../include/conn.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Data Mahasiswa</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
      padding: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      min-height: 100vh;
    }

    h1 {
      text-align: center;
      font-size: 2rem;
      margin-bottom: 1rem;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .back-link {
      margin-bottom: 2rem;
    }

    .back-link a {
      padding: 0.5rem 1rem;
      background-color: var(--white);
      color: var(--black);
      border: 2px solid var(--black);
      text-decoration: none;
      font-weight: 500;
      transition: var(--transition);
      box-shadow: var(--shadow);
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
    }

    .back-link a:hover {
      box-shadow: var(--shadow-hover);
      transform: translate(-2px, -2px);
    }

    .add-form {
      width: 100%;
      max-width: 600px;
      background-color: var(--white);
      border: 3px solid var(--black);
      padding: 2rem;
      box-shadow: var(--shadow);
      transition: var(--transition);
      margin-bottom: 2rem;
    }

    .add-form:hover {
      box-shadow: var(--shadow-hover);
    }

    .form-group {
      display: flex;
      flex-direction: column;
      margin-bottom: 1.5rem;
    }

    .form-group label {
      font-weight: 500;
      margin-bottom: 0.5rem;
    }

    .form-group input,
    .form-group textarea,
    .form-group select {
      padding: 0.8rem;
      border: 2px solid var(--black);
      font-family: inherit;
      font-size: 1rem;
      transition: var(--transition);
      box-shadow: var(--shadow);
    }

    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
      outline: none;
      box-shadow: var(--shadow-hover);
      transform: translate(-2px, -2px);
    }

    .form-group input:hover,
    .form-group textarea:hover,
    .form-group select:hover {
      box-shadow: var(--shadow-hover);
      transform: translate(-2px, -2px);
    }

    .form-group textarea {
      min-height: 100px;
      resize: vertical;
    }

    .radio-group {
      display: flex;
      gap: 1rem;
      align-items: center;
    }

    .radio-option {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .radio-option input[type="radio"] {
      width: 1.2rem;
      height: 1.2rem;
      border: 2px solid var(--black);
      appearance: none;
      cursor: pointer;
      box-shadow: var(--shadow);
      transition: var(--transition);
      position: relative;
    }

    .radio-option input[type="radio"]:checked {
      background-color: var(--black);
    }

    .radio-option input[type="radio"]:hover {
      box-shadow: var(--shadow-hover);
      transform: translate(-2px, -2px);
    }

    .submit-btn {
      padding: 0.8rem 1.5rem;
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
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
    }

    .submit-btn:hover {
      background-color: var(--black);
      color: var(--white);
      box-shadow: var(--shadow-hover);
      transform: translate(-2px, -2px);
    }

    .form-actions {
      display: flex;
      justify-content: flex-end;
      margin-top: 2rem;
    }

    @media (max-width: 768px) {
      .add-form {
        padding: 1.5rem;
      }
    }
  </style>
</head>

<body>
  <h1>Tambah Data Mahasiswa</h1>
  <div class="back-link">
    <a href="data.php">
      <i class="fas fa-arrow-left"></i> Kembali Ke Halaman Utama
    </a>
  </div>

  <form class="add-form" action="" method="post">
    <div class="form-group">
      <label for="nim">NIM</label>
      <input type="number" id="nim" name="nim" required>
    </div>

    <div class="form-group">
      <label for="nama">Nama</label>
      <input type="text" id="nama" name="nama" required>
    </div>

    <div class="form-group">
      <label for="tanggal">Tanggal Lahir</label>
      <input type="date" id="tanggal" name="tanggal" required>
    </div>

    <div class="form-group">
      <label>Jenis Kelamin</label>
      <div class="radio-group">
        <div class="radio-option">
          <input type="radio" id="jenisKelaminL" name="jenisKelamin" value="L" required>
          <label for="jenisKelaminL">Laki-laki</label>
        </div>
        <div class="radio-option">
          <input type="radio" id="jenisKelaminP" name="jenisKelamin" value="P" required>
          <label for="jenisKelaminP">Perempuan</label>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="alamat">Alamat</label>
      <textarea id="alamat" name="alamat" required></textarea>
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" required>
    </div>

    <div class="form-group">
      <label for="nohp">NO HP</label>
      <input type="tel" id="nohp" name="nohp" required>
    </div>

    <div class="form-group">
      <label for="prodi">Prodi</label>
      <input type="text" id="prodi" name="prodi" required>
    </div>

    <div class="form-group">
      <label for="angkatan">Angkatan</label>
      <input type="number" id="angkatan" name="angkatan" required>
    </div>

    <div class="form-actions">
      <button type="submit" name="submit" class="submit-btn" onclick="return confirm('Tambah Data?')">
        <i class="fas fa-plus-circle"></i> Tambah Data
      </button>
    </div>
  </form>
</body>

</html>

<?php
if (isset($_POST['submit'])) {
  $nim = $_POST['nim'];
  $nama = $_POST['nama'];
  $tanggal = $_POST['tanggal'];
  $jenisKelamin = $_POST['jenisKelamin'];
  $alamat = $_POST['alamat'];
  $email = $_POST['email'];
  $noHp = $_POST['nohp'];
  $prodi = $_POST['prodi'];
  $angkatan = $_POST['angkatan'];

  $query = "INSERT INTO mahasiswa VALUES('$nim', '$nama', '$tanggal', '$jenisKelamin', '$alamat', '$email', '$noHp', '$prodi', '$angkatan')";
  mysqli_query($conn, $query);
  if (mysqli_affected_rows($conn) > 0) {
    header("Location:data.php");
  } else {
    echo "<script>alert('Data Gagal Ditambahkan!')</script>";
  }
}
?>