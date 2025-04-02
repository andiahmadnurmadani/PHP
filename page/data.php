<?php
include "../include/conn.php";
include "../include/check_session.php";

function greet($username, $time)
{
  echo "<p>Selamat Datang, $username</p>";
  echo "<p>Waktu Login : $time</p>";
}

$query = "SELECT * FROM mahasiswa ORDER BY nama ASC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
      background-color: #f8f9fa;
    }

    table {
      width: 100%;
      border: 1px solid black;
      border-collapse: collapse;
      background-color: white;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    td {
      border: 1px solid black;
      padding: 5px;
    }

    thead {
      text-align: center;
    }

    h1,
    h3,
    h2 {
      text-align: center;
    }
  </style>
</head>

<body>
  <?php greet($_SESSION['fullname'], $_SESSION['time']) ?>
  <h1>Data Mahasiswa</h1>
  <h2><a href="tambah.php">[Tambah Data]</a></h2>
  <h2><a href="logout.php" style="color: red;" onclick="return confirm('Tetap ingin Log out?')">[Log Out]</a></h2>
  <?php
  $baris = "SELECT COUNT(*) as baris FROM mahasiswa";
  $exBaris = mysqli_query($conn, $baris);
  $data = mysqli_fetch_assoc($exBaris);
  if ($data['baris'] < 1) {
    echo "<h3>Data Kosong! silahkan <a href='tambah.php'>tambah data</a></h3>";
    return;
  }
  ?>
  <table>
    <thead>
      <tr>
        <td>NIM</td>
        <td>Nama</td>
        <td>Tanggal Lahir</td>
        <td>Jenis Kelamin</td>
        <td>Alamat</td>
        <td>Email</td>
        <td>NO HP</td>
        <td>Prodi</td>
        <td>Angkatan</td>
        <td>Aksi</td>
      </tr>
    </thead>
    <tbody>
      <?php while ($tampilkan = mysqli_fetch_assoc($result)) : ?>
        <tr>
          <td> <?= $tampilkan['nim'] ?> </td>
          <td> <?= $tampilkan['nama'] ?> </td>
          <td> <?= $tampilkan['tanggal_lahir'] ?> </td>
          <td> <?= $tampilkan['jenis_kelamin'] ?> </td>
          <td> <?= $tampilkan['alamat'] ?> </td>
          <td> <?= $tampilkan['email'] ?> </td>
          <td> <?= $tampilkan['no_hp'] ?> </td>
          <td> <?= $tampilkan['prodi'] ?> </td>
          <td> <?= $tampilkan['angkatan'] ?> </td>
          <td>
            <a href="edit.php?nim=<?= $tampilkan['nim'] ?>">Edit</a> |
            <a href="hapus.php?nim=<?= $tampilkan['nim'] ?>" onclick="return confirm('Yakin Ingin Menghapus?')">Hapus</a>
          </td>
        </tr>
      <?php endwhile ?>
    </tbody>
  </table>
</body>

</html>