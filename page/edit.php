<?php
include "../include/conn.php";
include "../include/check_session.php";

$nim = $_GET['nim'];
$query = "SELECT * FROM mahasiswa WHERE nim = $nim";
$result = mysqli_query($conn, $query);
$tampilkan = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
  $nimbaru = $_POST['nimBaru'];
  $nama = $_POST['nama'];
  $tanggal = $_POST['tanggalLahir'];
  $jenisKelamin = $_POST['jeniskelamin'];
  $alamat = $_POST['alamat'];
  $email = $_POST['email'];
  $nohp = $_POST['nohp'];
  $prodi = $_POST['prodi'];
  $angkatan = $_POST['angkatan'];
  $queryUpdate = "UPDATE mahasiswa SET nim='$nimbaru', nama='$nama', tanggal_lahir='$tanggal', jenis_kelamin = '$jenisKelamin', alamat='$alamat', email='$email', no_hp='$nohp', prodi='$prodi', angkatan='$angkatan' WHERE nim='$nim'";
  $update = mysqli_query($conn, $queryUpdate);
  if (mysqli_affected_rows($conn) > 0) {
    echo "<script>alert('Data Berhasil diubah')</script>";
    header("Location:data.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Data Mahasiswa</title>
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

    .edit-form {
      width: 100%;
      max-width: 600px;
      background-color: var(--white);
      border: 3px solid var(--black);
      padding: 2rem;
      box-shadow: var(--shadow);
      transition: var(--transition);
    }

    .edit-form:hover {
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
      .edit-form {
        padding: 1.5rem;
      }
    }
  </style>
</head>

<body>
  <h1>Ubah Data Mahasiswa</h1>
  <div class="back-link">
    <a href="data.php">
      <i class="fas fa-arrow-left"></i> Kembali Ke Halaman Utama
    </a>
  </div>

  <form class="edit-form" action="" method="post">
    <div class="form-group">
      <label for="nim">NIM</label>
      <input type="number" id="nim" name="nim" value="<?= $tampilkan['nim'] ?>" disabled>
    </div>

    <div class="form-group">
      <label for="nimBaru">NIM Baru</label>
      <input type="number" id="nimBaru" name="nimBaru" value="<?= $tampilkan['nim'] ?>">
    </div>

    <div class="form-group">
      <label for="nama">Nama</label>
      <input type="text" id="nama" name="nama" value="<?= $tampilkan['nama'] ?>">
    </div>

    <div class="form-group">
      <label for="tanggalLahir">Tanggal Lahir</label>
      <input type="date" id="tanggalLahir" name="tanggalLahir" value="<?= $tampilkan['tanggal_lahir'] ?>">
    </div>

    <div class="form-group">
      <label>Jenis Kelamin</label>
      <div class="radio-group">
        <div class="radio-option">
          <input type="radio" id="jeniskelaminL" name="jeniskelamin" value="L" <?= $tampilkan['jenis_kelamin'] == "L" ? "checked" : "" ?>>
          <label for="jeniskelaminL">Laki-laki</label>
        </div>
        <div class="radio-option">
          <input type="radio" id="jeniskelaminP" name="jeniskelamin" value="P" <?= $tampilkan['jenis_kelamin'] == "P" ? "checked" : "" ?>>
          <label for="jeniskelaminP">Perempuan</label>
        </div>
      </div>
    </div>

    <div class="form-group">
      <label for="alamat">Alamat</label>
      <textarea id="alamat" name="alamat"><?= $tampilkan['alamat'] ?></textarea>
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" id="email" name="email" value="<?= $tampilkan['email'] ?>">
    </div>

    <div class="form-group">
      <label for="nohp">NO HP</label>
      <input type="tel" id="nohp" name="nohp" value="<?= $tampilkan['no_hp'] ?>">
    </div>

    <div class="form-group">
      <label for="prodi">Prodi</label>
      <input type="text" id="prodi" name="prodi" value="<?= $tampilkan['prodi'] ?>">
    </div>

    <div class="form-group">
      <label for="angkatan">Angkatan</label>
      <input type="number" id="angkatan" name="angkatan" value="<?= $tampilkan['angkatan'] ?>">
    </div>

    <div class="form-actions">
      <button type="submit" name="submit" class="submit-btn">
        <i class="fas fa-save"></i> Simpan Perubahan
      </button>
    </div>
  </form>
</body>

</html>