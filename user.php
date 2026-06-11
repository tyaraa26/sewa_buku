<?php
session_start();
if (!isset($_SESSION["login"]) || $_SESSION["role"] !== 'user') {
    header("Location: ../users/login_user.php");
    exit;
}
include '../koneksi.php';
$id_user = $_SESSION["id_user"];
$nama_user = $_SESSION["nama_user"];
$buku = mysqli_query($conn, "SELECT * FROM buku WHERE stok > 0");

if (isset($_GET["pinjam"])) {
    $id_buku = intval($_GET["pinjam"]);
    $cari_buku = mysqli_query($conn, "SELECT judul FROM buku WHERE id = $id_buku");
    $data_buku = mysqli_fetch_assoc($cari_buku);
    $judul_buku = $data_buku['judul'];

    $tanggal_pinjam = date('Y-m-d');
    $batas_kembali = date('Y-m-d', strtotime('+7 days'));
    $status = 'dipinjam';

    $query_insert = "INSERT INTO penyewaan VALUES ('', '$nama_user', '$judul_buku', '$tanggal_pinjam', '$batas_kembali', '', '$status', 0)";
    $insert = mysqli_query($conn, $query_insert);

    if ($insert) {
        mysqli_query($conn, "UPDATE buku SET stok = stok - 1 WHERE id = $id_buku");
        echo "<script>alert('Buku berhasil dipinjam!'); document.location.href = 'user.php';</script>";
    } else {
        echo "<script>alert('Gagal meminjam buku!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard Member</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h2>Selamat Datang, <?= $nama_user; ?>! 👋</h2>
    <nav>
        <a href="user.php" style="font-weight: bold;">Katalog Buku</a> | 
        <a href="penyewaan_saya.php">Penyewaan Saya</a> | 
        <a href="../users/logout.php" onclick="return confirm('Yakin logout?');" style="color: red;">Logout</a>
    </nav>
    <br><br>
    <h3>Katalog Buku Tersedia</h3>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Cover</th>
            <th>Judul Buku</th>
            <th>Penulis</th>
            <th>Tahun Terbit</th>
            <th>Genre</th>
            <th>Stok Tersisa</th>
            <th>Harga Sewa</th>
            <th>Aksi</th>
        </tr>
        <?php $i = 1; while($row = mysqli_fetch_assoc($buku)) : ?>
        <tr>
            <td><?= $i++; ?></td>
            <td><img src="../img/<?= $row['gambar']; ?>" width="50" alt="cover"></td>
            <td><?= $row['judul']; ?></td>
            <td><?= $row['penulis']; ?></td>
            <td><?= $row['penerbit']; ?></td>
            <td><?= $row['genre']; ?></td>
            <td><?= $row['stok']; ?> bks</td>
            <td>Rp <?= number_format($row['harga_sewa'], 0, ',', '.'); ?></td>
            <td><a href="user.php?pinjam=<?= $row['id']; ?>" onclick="return confirm('Pinjam buku ini?');" style="background: #28a745; color: white; padding: 5px 10px; text-decoration: none; border-radius: 3px;">Pinjam Buku</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>