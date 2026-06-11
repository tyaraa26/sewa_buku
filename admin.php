<?php
session_start();
if (!isset($_SESSION["login"]) || $_SESSION["role"] !== 'admin') {
    header("Location: users/login_admin.php");
    exit;
}
include 'koneksi.php';
$nama_admin = $_SESSION["nama_admin"];
$total_buku = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM buku"));
$total_sewa = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM penyewaan WHERE status = 'dipinjam'"));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard Admin - E-Library</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Panel Kendali Admin 🛠️</h2>
    <p>Halo, <strong><?= $nama_admin; ?></strong> (Petugas)</p>
    <hr>
    <div style="display: flex; gap: 20px; margin: 20px 0;">
        <div style="background: #e3f2fd; padding: 20px; border-radius: 5px; flex: 1;">
            <h3>📚 Total Koleksi</h3>
            <p><?= $total_buku; ?> Judul Buku</p>
        </div>
        <div style="background: #fff3e0; padding: 20px; border-radius: 5px; flex: 1;">
            <h3>🔄 Sedang Dipinjam</h3>
            <p><?= $total_sewa; ?> Transaksi Aktif</p>
        </div>
    </div>
    <h3>Menu Navigasi Data:</h3>
    <ul>
        <li><a href="buku/index.php" style="font-size: 1.2em; font-weight: bold;">Kelola Data Master Buku </a></li>
        <li><a href="penyewaan/index.php" style="font-size: 1.2em; font-weight: bold; color: green;">Kelola Pengembalian & Cek Denda</a></li>
        <br>
        <li><a href="users/logout.php" onclick="return confirm('Yakin ingin keluar?');" style="color: red;">Log Out</a></li>
    </ul>
</body>
</html>