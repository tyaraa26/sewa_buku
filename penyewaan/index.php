<?php
include 'functions.php';
$penyewaan = query("SELECT * FROM penyewaan");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Kelola Data Penyewaan</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h2>Data Transaksi & Denda Penyewaan Buku (Admin)</h2>
    <a href="../admin.php">Kembali ke Dashboard Admin</a>
    <br><br>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Nama Peminjam</th>
            <th>Judul Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Batas Kembali</th>
            <th>Status</th>
            <th>Denda</th>
            <th>Aksi</th>
        </tr>
        <?php $i = 1; foreach($penyewaan as $row) : ?>
        <tr>
            <td><?= $i++; ?></td>
            <td><?= $row['pengguna']; ?></td>
            <td><?= $row['judul_buku']; ?></td>
            <td><?= date('d-m-Y', strtotime($row['tanggal_pinjam'])); ?></td>
            <td><?= date('d-m-Y', strtotime($row['batas_kembali'])); ?></td>
            <td><strong style="color: <?= ($row['status'] == 'dipinjam') ? 'orange' : 'green'; ?>;"><?= strtoupper($row['status']); ?></strong></td>
            <td>Rp <?= number_format($row['denda'], 0, ',', '.'); ?></td>
            <td>
                <?php if($row['status'] == 'dipinjam') : ?>
                    <a href="konfirmasi.php?id=<?= $row['id']; ?>" style="color: blue; font-weight: bold;">Cek Pengembalian / Denda</a> |
                <?php endif; ?>
                <a href="hapus.php?id=<?= $row['id']; ?>" onclick="return confirm('Hapus transaksi?');">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>