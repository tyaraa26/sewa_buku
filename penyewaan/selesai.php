<?php
include 'functions.php';
$id = $_GET["id"];
if (hitungDanSelesaikan($id) > 0) {
    echo "<script>alert('Pengembalian berhasil diproses!'); document.location.href = 'index.php';</script>";
} else {
    echo "<script>alert('Gagal memproses pengembalian!'); document.location.href = 'index.php';</script>";
}
?>