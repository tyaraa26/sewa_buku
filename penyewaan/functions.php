<?php
include '../koneksi.php';

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function hitungDanSelesaikan($id) {
    global $conn;
    $sewa = query("SELECT * FROM penyewaan WHERE id = $id")[0];
    $judul_buku = $sewa['judul_buku'];
    
    $tgl_kembali_seharusnya = new DateTime($sewa['batas_kembali']);
    $tgl_sekarang = new DateTime(date('Y-m-d'));
    
    $denda = 0;
    if ($tgl_sekarang > $tgl_kembali_seharusnya) {
        $selisih = $tgl_sekarang->diff($tgl_kembali_seharusnya)->days;
        $denda = $selisih * 2000;
    }

    $query = "UPDATE penyewaan SET status = 'kembali', denda = $denda WHERE id = $id";
    mysqli_query($conn, $query);

    mysqli_query($conn, "UPDATE buku SET stok = stok + 1 WHERE judul = '$judul_buku'");
    return mysqli_affected_rows($conn);
}

function hapusPenyewaan($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM penyewaan WHERE id = $id");
    return mysqli_affected_rows($conn);
}
?>