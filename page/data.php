<?php
include "../include/conn.php";
include "../include/check_session.php";

function greet($username, $time)
{
  echo "<div class='welcome-box'>";
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
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    :root {
      --black: #111111;
      --white: #ffffff;
      --gray-100: #f5f5f5;
      --gray-200: #eeeeee;
      --gray-500: #9e9e9e;
      --gray-700: #616161;
      --gray-900: #212121;
    }
    
    /* Base Styles */
    body {
      font-family: 'Inter', sans-serif;
      margin: 0;
      padding: 0;
      background-color: var(--white);
      color: var(--black);
      line-height: 1.6;
    }
    
    .container {
      max-width: 1400px;
      margin: 0 auto;
      padding: 2rem;
    }
    
    /* Header Styles */
    .header {
      margin-bottom: 2.5rem;
      text-align: center;
    }
    
    h1 {
      color: var(--black);
      margin: 0 0 1rem 0;
      font-size: 2rem;
      font-weight: 700;
      letter-spacing: -0.5px;
    }
    
    /* Welcome Box */
    .welcome-box {
      background-color: var(--white);
      padding: 1.5rem;
      border-radius: 0.5rem;
      margin-bottom: 2rem;
      border: 1px solid var(--gray-200);
      box-shadow: 0 1px 3px rgba(0,0,0,0.03);
    }
    
    .welcome-box p {
      margin: 0.5rem 0;
      color: var(--gray-700);
    }
    
    .welcome-box strong {
      color: var(--black);
      font-weight: 600;
    }
    
    /* Action Buttons */
    .action-buttons {
      display: flex;
      justify-content: center;
      gap: 1rem;
      margin-bottom: 2.5rem;
    }
    
    .btn {
      padding: 0.75rem 1.5rem;
      border-radius: 0.375rem;
      text-decoration: none;
      font-weight: 500;
      transition: all 0.2s ease;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 0.875rem;
      border: 1px solid transparent;
    }
    
    .btn-outline {
      background-color: transparent;
      border-color: var(--black);
      color: var(--black);
    }
    
    .btn-outline:hover {
      background-color: var(--black);
      color: var(--white);
    }
    
    /* Table Styles */
    .table-container {
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
      border-radius: 0.5rem;
      border: 1px solid var(--gray-200);
    }
    
    table {
      width: 100%;
      border-collapse: collapse;
      background-color: var(--white);
      min-width: 800px;
    }
    
    th, td {
      padding: 1rem 1.25rem;
      text-align: left;
      border-bottom: 1px solid var(--gray-200);
    }
    
    th {
      background-color: var(--black);
      color: var(--white);
      font-weight: 600;
      text-transform: uppercase;
      font-size: 0.75rem;
      letter-spacing: 0.5px;
    }
    
    tr:last-child td {
      border-bottom: none;
    }
    
    tr:hover {
      background-color: var(--gray-100);
    }
    
    /* Action Links */
    .action-links {
      display: flex;
      gap: 1rem;
    }
    
    .action-links a {
      color: var(--black);
      text-decoration: none;
      transition: all 0.2s ease;
      font-size: 0.875rem;
      font-weight: 500;
      display: flex;
      align-items: center;
      gap: 0.375rem;
    }
    
    .action-links a:hover {
      color: var(--gray-700);
    }
    
    /* Empty State */
    .empty-state {
      text-align: center;
      padding: 3rem;
      background-color: var(--white);
      border-radius: 0.5rem;
      border: 1px solid var(--gray-200);
      margin-top: 2rem;
    }
    
    .empty-state h3 {
      color: var(--black);
      margin-bottom: 1rem;
    }
    
    .empty-state a {
      color: var(--black);
      text-decoration: none;
      font-weight: 500;
      border-bottom: 1px solid currentColor;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
      .container {
        padding: 1.25rem;
      }
      
      .action-buttons {
        flex-direction: column;
      }
      
      .btn {
        justify-content: center;
      }
    }
    
    /* Animations */
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    
    .welcome-box, .action-buttons, .table-container, .empty-state {
      animation: fadeIn 0.4s ease-out forwards;
    }
    
    .table-container {
      animation-delay: 0.1s;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="header">
      <h1>DATA MAHASISWA</h1>
    </div>
    
    <?php greet($_SESSION['fullname'], $_SESSION['time']) ?>
    
    <div class="action-buttons">
      <a href="tambah.php" class="btn btn-outline">
        <i class="fas fa-plus"></i> Tambah Data
      </a>
      <a href="logout.php" class="btn btn-outline" onclick="return confirm('Tetap ingin Log out?')">
        <i class="fas fa-sign-out-alt"></i> Log Out
      </a>
    </div>
    
    <?php
    $baris = "SELECT * FROM mahasiswa";
    $exBaris = mysqli_query($conn, $baris);
    if (mysqli_num_rows($exBaris) < 1) {
      echo "<div class='empty-state'>
              <h3><i class='fas fa-database'></i> DATA KOSONG</h3>
              <p>Silahkan <a href='tambah.php'>tambah data</a> untuk memulai</p>
            </div>";
      return;
    }
    ?>
    
    <div class="table-container">
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
                <div class="action-links">
                  <a href="edit.php?nim=<?= $tampilkan['nim'] ?>">
                    <i class="fas fa-pencil-alt"></i> Edit
                  </a>
                  <a href="hapus.php?nim=<?= $tampilkan['nim'] ?>" onclick="return confirm('Yakin Ingin Menghapus?')">
                    <i class="fas fa-trash"></i> Hapus
                  </a>
                </div>
              </td>
            </tr>
          <?php endwhile ?>
        </tbody>
      </table>
    </div>
  </div>
</body>

</html>