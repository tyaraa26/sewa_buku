<?php
include "functions.php";

if (isset($_POST["submit"])) {

    if (tambah($_POST) > 0) {
        echo "<script>
            alert('Data berhasil ditambah');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('Data gagal ditambah');
        </script>";
    }
}
?>

<h2>Tambah Penyewaan</h2>

<form method="post">

    <p>Pengguna</p>
    <input type="text" name="pengguna" required>

    <p>Judul Buku</p>
    <input type="text" name="judul_buku" required>

    <p>Tanggal Pinjam</p>
    <input type="date" name="tanggal_pinjam" required>

    <br><br>
    <button type="submit" name="submit">Simpan</button>
</form>