<?php
include "../include/conn.php";
include "../include/check_session.php";

function greet($username, $time) {
  echo "<div class='greeting'>";
  echo "<p>Selamat Datang, <strong>$username</strong></p>";
  echo "<p>Waktu Login: <strong>$time</strong></p>";
  echo "</div>";
}

$query = "SELECT * FROM mahasiswa ORDER BY nama ASC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Mahasiswa</title>
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
      padding: 20px;
    }

    .greeting {
      background-color: var(--white);
      border: 2px solid var(--black);
      padding: 1rem;
      margin-bottom: 2rem;
      box-shadow: var(--shadow);
      max-width: 600px;
      margin-left: auto;
      margin-right: auto;
    }

    h1 {
      text-align: center;
      font-size: 2rem;
      margin-bottom: 1.5rem;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .action-links {
      display: flex;
      justify-content: center;
      gap: 1.5rem;
      margin-bottom: 2rem;
      flex-wrap: wrap;
    }

    .action-links a {
      padding: 0.5rem 1rem;
      background-color: var(--white);
      color: var(--black);
      border: 2px solid var(--black);
      text-decoration: none;
      font-weight: 500;
      transition: var(--transition);
      box-shadow: var(--shadow);
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .action-links a:hover {
      box-shadow: var(--shadow-hover);
      transform: translate(-2px, -2px);
    }

    .action-links a.logout {
      border-color: var(--black);
      color: var(--black);
    }

    .action-links a.logout:hover {
      background-color: var(--black);
      color: var(--white);
    }

    table {
      width: 100%;
      border: 3px solid var(--black);
      border-collapse: collapse;
      background-color: var(--white);
      box-shadow: var(--shadow);
      margin: 0 auto;
      max-width: 1200px;
    }

    th, td {
      border: 2px solid var(--black);
      padding: 0.8rem;
      text-align: left;
    }

    th {
      background-color: var(--white);
      font-weight: 600;
      text-transform: uppercase;
      font-size: 0.9rem;
      letter-spacing: 0.5px;
    }

    tr:nth-child(even) {
      background-color: var(--gray);
    }

    tr:hover {
      background-color: var(--dark-gray);
    }

    .action-buttons {
      display: flex;
      gap: 0.5rem;
    }

    .action-buttons a {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 0.3rem 0.6rem;
      border: 2px solid var(--black);
      text-decoration: none;
      color: var(--black);
      border-radius: 0;
      transition: var(--transition);
      box-shadow: var(--shadow);
      gap: 0.3rem;
    }

    .action-buttons a:hover {
      box-shadow: var(--shadow-hover);
      transform: translate(-2px, -2px);
    }

    .action-buttons a.edit {
      background-color: var(--white);
    }

    .action-buttons a.edit:hover {
      background-color: #f0f0f0;
    }

    .action-buttons a.delete {
      background-color: var(--white);
    }

    .action-buttons a.delete:hover {
      background-color: #ffebee;
    }

    .empty-message {
      text-align: center;
      margin: 2rem 0;
      font-size: 1.1rem;
    }

    .empty-message a {
      display: inline-flex;
      align-items: center;
      margin-top: 1rem;
      padding: 0.5rem 1rem;
      border: 2px solid var(--black);
      box-shadow: var(--shadow);
      text-decoration: none;
      color: var(--black);
      gap: 0.5rem;
    }

    .empty-message a:hover {
      box-shadow: var(--shadow-hover);
      transform: translate(-2px, -2px);
    }

    @media (max-width: 768px) {
      table {
        display: block;
        overflow-x: auto;
      }
      
      .action-links {
        flex-direction: column;
        align-items: center;
        gap: 0.8rem;
      }
      
      .action-buttons {
        flex-direction: column;
        gap: 0.3rem;
      }
    }
  </style>
</head>

<body>
  <?php greet($_SESSION['fullname'], $_SESSION['time']) ?>
  <h1>Data Mahasiswa</h1>
  
  <div class="action-links">
    <a href="tambah.php">
      <i class="fas fa-plus"></i> Tambah Data
    </a>
    <a href="logout.php" class="logout" onclick="return confirm('Tetap ingin Log out?')">
      <i class="fas fa-sign-out-alt"></i> Log Out
    </a>
  </div>

  <?php
  $baris = "SELECT * FROM mahasiswa";
  $exBaris = mysqli_query($conn, $baris);
  $data = mysqli_fetch_assoc($exBaris);
  if (mysqli_num_rows($exBaris) < 1) {
    echo "<div class='empty-message'>";
    echo "<h3>Data Kosong!</h3>";
    echo "<a href='tambah.php'><i class='fas fa-plus'></i> Tambah Data</a>";
    echo "</div>";
    return;
  }
  ?>
  
  <table>
    <thead>
      <tr>
        <th>NIM</th>
        <th>Nama</th>
        <th>Tanggal Lahir</th>
        <th>Jenis Kelamin</th>
        <th>Alamat</th>
        <th>Email</th>
        <th>NO HP</th>
        <th>Prodi</th>
        <th>Angkatan</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($tampilkan = mysqli_fetch_assoc($result)) : ?>
        <tr>
          <td><?= $tampilkan['nim'] ?></td>
          <td><?= $tampilkan['nama'] ?></td>
          <td><?= $tampilkan['tanggal_lahir'] ?></td>
          <td><?= $tampilkan['jenis_kelamin'] ?></td>
          <td><?= $tampilkan['alamat'] ?></td>
          <td><?= $tampilkan['email'] ?></td>
          <td><?= $tampilkan['no_hp'] ?></td>
          <td><?= $tampilkan['prodi'] ?></td>
          <td><?= $tampilkan['angkatan'] ?></td>
          <td>
            <div class="action-buttons">
              <a href="edit.php?nim=<?= $tampilkan['nim'] ?>" class="edit">
                <i class="fas fa-edit"></i> Edit
              </a>
              <a href="hapus.php?nim=<?= $tampilkan['nim'] ?>" class="delete" onclick="return confirm('Yakin Ingin Menghapus?')">
                <i class="fas fa-trash-alt"></i> Hapus
              </a>
            </div>
          </td>
        </tr>
      <?php endwhile ?>
    </tbody>
  </table>
</body>

</html>