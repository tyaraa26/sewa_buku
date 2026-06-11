<?php
include 'functions.php';
$id = $_GET["id"];
if (hapusPenyewaan($id) > 0) {
    echo "<script>alert('Transaksi berhasil dihapus!'); document.location.href = 'index.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus transaksi!'); document.location.href = 'index.php';</script>";
}
?>