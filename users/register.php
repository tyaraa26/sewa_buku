<?php
include '../koneksi.php';
if (isset($_POST["register"])) {
    $nama = htmlspecialchars($_POST["nama"]);
    $username = strtolower(stripslashes(htmlspecialchars($_POST["username"])));
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $role = $_POST["role"];

    $password_hashed = password_hash($password, PASSWORD_DEFAULT);
    $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>alert('Username sudah digunakan!');</script>";
    } else {
        mysqli_query($conn, "INSERT INTO users VALUES('', '$nama', '$username', '$password_hashed', '$role')");
        echo "<script>alert('Registrasi Berhasil!'); document.location.href = 'login_user.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Register Akun</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h2>Buat Akun Baru</h2>
    <form action="" method="post">
        <input type="text" name="nama" placeholder="Nama Lengkap" required><br><br>
        <input type="text" name="username" placeholder="Username (Tanpa Spasi)" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <label>Role:</label>
        <select name="role">
            <option value="user">User / Anggota Perpustakaan</option>
            <option value="admin">Admin / Petugas</option>
        </select><br><br>
        <button type="submit" name="register">Daftar Akun</button>
    </form>
    <p><a href="login_user.php">Sudah punya akun? Login</a></p>
</body>
</html>