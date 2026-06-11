<?php
include "functions.php";

$id = $_GET["id"];
$data = query("SELECT * FROM penyewaan WHERE id = $id")[0];

if (isset($_POST["submit"])) {

    if (ubah($_POST) > 0) {
        echo "<script>
            alert('Data berhasil diubah');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal diubah');
        </script>";
    }
}
?>

<h2>Edit Penyewaan</h2>

<form method="post">

    <input type="hidden" name="id" value="<?= $data['id']; ?>">

    <p>Pengguna</p>
    <input type="text" name="pengguna" value="<?= $data['pengguna']; ?>">

    <p>Judul Buku</p>
    <input type="text" name="judul_buku" value="<?= $data['judul_buku']; ?>">

    <p>Tanggal Pinjam</p>
    <input type="date" name="tanggal_pinjam" value="<?= $data['tanggal_pinjam']; ?>">

    <p>Tanggal Kembali</p>
    <input type="date" name="tanggal_kembali" value="<?= $data['tanggal_kembali']; ?>">

    <p>Status</p>
    <input type="text" name="status" value="<?= $data['status']; ?>">

    <p>Denda</p>
    <input type="number" name="denda" value="<?= $data['denda']; ?>">

    <br><br>
    <button type="submit" name="submit">Update</button>
</form>