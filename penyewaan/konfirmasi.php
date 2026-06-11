<?php
include 'functions.php';
$id = $_GET["id"];
$sewa = query("SELECT * FROM penyewaan WHERE id = $id")[0];

$tgl_kembali_seharusnya = new DateTime($sewa['batas_kembali']);
$tgl_sekarang = new DateTime(date('Y-m-d'));
$hari_terlambat = 0;
$total_denda = 0;

if ($tgl_sekarang > $tgl_kembali_seharusnya) {
    $hari_terlambat = $tgl_sekarang->diff($tgl_kembali_seharusnya)->days;
    $total_denda = $hari_terlambat * 2000;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Konfirmasi Pengembalian & Denda</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h2>Konfirmasi Pengembalian Buku</h2>
    <div style="border: 1px solid #ccc; padding: 20px; max-width: 500px; background: white;">
        <p><strong>Nama Peminjam:</strong> <?= $sewa['pengguna']; ?></p>
        <p><strong>Judul Buku:</strong> <?= $sewa['judul_buku']; ?></p>
        <p><strong>Tanggal Pinjam:</strong> <?= date('d-m-Y', strtotime($sewa['tanggal_pinjam'])); ?></p>
        <p><strong>Batas Kembali:</strong> <?= date('d-m-Y', strtotime($sewa['batas_kembali'])); ?></p>
        <p><strong>Tanggal Dikembalikan:</strong> <?= date('d-m-Y'); ?></p>
        <hr>
        <p><strong>Keterlambatan:</strong> <?= $hari_terlambat; ?> Hari</p>
        <p style="color: red; font-size: 1.2em;"><strong>Total Denda:</strong> Rp <?= number_format($total_denda, 0, ',', '.'); ?></p>
        <br>
        <a href="selesai.php?id=<?= $sewa['id']; ?>" style="background: green; color: white; padding: 10px; text-decoration: none; font-weight: bold;">Proses Kembalikan Buku</a> | 
        <a href="index.php">Batal</a>
    </div>
</body>
</html>