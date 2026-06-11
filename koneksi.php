<?php
$conn = mysqli_connect("localhost", "root", "", "e_library");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>