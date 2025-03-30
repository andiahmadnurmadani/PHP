<?php
include "conn.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Data</title>
</head>
<body>
  <h1>Tambah Data</h1>
  <form action="" method="post">
    <table>
      <tr>
        <td><label for="nim">NIM</label></td>
        <td>:</td>
        <td><input type="number" id="nim" name="nim"></td>
      </tr>
      <tr>
        <td><label for="nama">Nama</label></td>
        <td>:</td>
        <td><input type="text" id="nama" name="nama"></td>
      </tr>
      <tr>
        <td><label for="tanggal">Tanggal Lahir</label></td>
        <td>:</td>
        <td><input type="date" id="tanggal" name="tanggal"></td>
      </tr>
      <tr>
        <td><label for="jenisKelamin">Jenis Kelamin</label></td>
        <td>:</td>
        <td><input type="radio" id="jenisKelamin" name="jenisKelamin" value="L">Laki Laki</td>
        <td><input type="radio" id="jenisKelamin" name="jenisKelamin" value="P">Perempuan</td>
      </tr>
      <tr>
        <td><label for="alamat">Alamat</label></td>
        <td>:</td>
        <td><textarea id="alamat" name="alamat"></textarea></td>
      </tr>
      <tr>
        <td><label for="email">Email</label></td>
        <td>:</td>
        <td><input type="email" id="email" name="email"></td>
      </tr>
      <tr>
        <td><label for="nohp">NO HP</label></td>
        <td>:</td>
        <td><input type="tel" id="nohp" name="nohp"></td>
      </tr>
      <tr>
        <td><label for="prodi">Prodi</label></td>
        <td>:</td>
        <td><input type="text" id="prodi" name="prodi"></td>
      </tr>
      <tr>
        <td><label for="angkatan">Angkatan</label></td>
        <td>:</td>
        <td><input type="number" id="angkatan" name="angkatan"></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td><button type="submit" name="submit" onclick="confirm('Tambah Data?')">Kirim!</button></td>
      </tr>
    </table>
  </form>
  <h2><a href="index.php">Kembali Ke Halaman Utama</a></h2>
</body>
</html>

<?php
  if(isset($_POST['submit'])) {
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
      header("Location:index.php");
    } else {
      echo  "<script>alert('Data Gagal Ditambahkan!')</script>";
    }
  }
?>