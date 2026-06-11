<?php
session_start();
if (!isset($_SESSION["login"]) || $_SESSION["role"] !== 'user') {
    header("Location: ../users/login_user.php");
    exit;
}
include '../koneksi.php';
$nama_user = $_SESSION["nama_user"];
$query = "SELECT * FROM penyewaan WHERE pengguna = '$nama_user'";
$riwayat = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Penyewaan Saya</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h2>Data Penyewaan Buku Kamu, <?= $nama_user; ?></h2>
    <nav>
        <a href="user.php">Katalog Buku</a> | 
        <a href="penyewaan_saya.php" style="font-weight: bold;">Penyewaan Saya</a> | 
        <a href="../users/logout.php" onclick="return confirm('Yakin logout?');" style="color: red;">Logout</a>
    </nav>
    <br><br>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Judul Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Batas Pengembalian</th>
            <th>Status</th>
            <th>Denda Keterlambatan</th>
        </tr>
        <?php if (!$riwayat || mysqli_num_rows($riwayat) == 0) : ?>
        <tr><td colspan="6" align="center" style="font-style: italic; color: #777;">Kamu belum meminjam buku apapun.</td></tr>
        <?php else : ?>
            <?php $i = 1; while($row = mysqli_fetch_assoc($riwayat)) : ?>
            <tr>
                <td><?= $i++; ?></td>
                <td><?= $row['judul_buku']; ?></td>
                <td><?= date('d-m-Y', strtotime($row['tanggal_pinjam'])); ?></td>
                <td><?= date('d-m-Y', strtotime($row['batas_kembali'])); ?></td>
                <td><span style="padding: 3px 8px; border-radius: 3px; color: white; font-weight: bold; background-color: <?= ($row['status'] == 'dipinjam') ? 'orange' : 'green'; ?>;"><?= strtoupper($row['status']); ?></span></td>
                <td style="color: <?= ($row['denda'] > 0) ? 'red' : 'black'; ?>; font-weight: <?= ($row['denda'] > 0) ? 'bold' : 'normal'; ?>;">Rp <?= number_format($row['denda'], 0, ',', '.'); ?></td>
            </tr>
            <?php endwhile; ?>
        <?php endif; ?>
    </table>
</body>
</html>