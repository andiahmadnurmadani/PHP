<?php
include "conn.php";

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
    header("Location:index.php");
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Data</title>
  <style>
  </style>
</head>

<body>
  <h1>Ubah data mahasiswa</h1>
  <a href="index.php">[Kembali Ke Halaman Utama]</a>
  <form action="" method="post">
    <table>
      <tr>
        <td><label for="nim">NIM </label></td>
        <td>:</td>
        <td><input type="number" id="nim" name="nim" value="<?= $tampilkan['nim'] ?>" disabled></td>
      </tr>

      <tr>
        <td><label for="nimBaru">NIM Baru </label></td>
        <td>:</td>
        <td><input type="number" id="nimBaru" name="nimBaru" value="<?= $tampilkan['nim'] ?>"></td>
      </tr>

      <tr>
        <td><label for="nama">Nama</label></td>
        <td>:</td>
        <td><input type="text" id="nama" name="nama" value="<?= $tampilkan['nama'] ?>"></td>
      </tr>

      <tr>
        <td><label for="tanggalLahir">Tanggal Lahir</label></td>
        <td>:</td>
        <td><input type="date" id="tanggalLahir" name="tanggalLahir" value="<?= $tampilkan['tanggal_lahir'] ?>"></td>
      </tr>
      <tr>
        <td><label for="jeniskelamin">Jenis Kelamin</label></td>
        <td>:</td>
        <td><input type="radio" id="jeniskelamin" name="jeniskelamin" value="L" <?= $tampilkan['jenis_kelamin'] == "L" ? "checked" : "" ?>>Laki Laki</td>
        <td><input type="radio" id="jeniskelamin" name="jeniskelamin" value="P" <?= $tampilkan['jenis_kelamin'] == "P" ? "checked" : "" ?>>Perempuan</td>
      </tr>
      <tr>
        <td><label for="alamat">Alamat</label></td>
        <td>:</td>
        <td><textarea id="alamat" name="alamat"><?= $tampilkan['alamat'] ?></textarea></td>
      </tr>
      <tr>
        <td><label for="email">Email</label></td>
        <td>:</td>
        <td><input type="email" id="email" name="email" value="<?= $tampilkan['email'] ?>"></td>
      </tr>
      <tr>
        <td><label for="nohp">NO HP</label></td>
        <td>:</td>
        <td><input type="tel" id="nohp" name="nohp" value="<?= $tampilkan['no_hp'] ?>"></td>
      </tr>
      <tr>
        <td><label for="prodi">Prodi</label></td>
        <td>:</td>
        <td><input type="text" id="prodi" name="prodi" value="<?= $tampilkan['prodi'] ?>"></td>
      </tr>
      <tr>
        <td><label for="angkatan">Angkatan</label></td>
        <td>:</td>
        <td><input type="number" id="angkatan" name="angkatan" value="<?= $tampilkan['angkatan'] ?>"></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td><button type="submit" name="submit">Ubah</button></td>
      </tr>

    </table>
  </form>
</body>

</html>