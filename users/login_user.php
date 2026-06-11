<?php
session_start();
include '../koneksi.php';
if (isset($_POST["login"])) {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' AND role = 'user'");
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            $_SESSION["login"] = true;
            $_SESSION["id_user"] = $row["id"];
            $_SESSION["nama_user"] = $row["nama"];
            $_SESSION["role"] = "user";
            header("Location: ../user/user.php");
            exit;
        }
    }
    $error = true;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Login Member</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h2>Login Anggota E-Library</h2>
    <?php if (isset($error)) : ?>
        <p style="color: red; font-style: italic;">Username / password salah atau bukan member!</p>
    <?php endif; ?>
    <form action="" method="post">
        <input type="text" name="username" placeholder="Username" required><br><br>
        <input type="password" name="password" placeholder="Password" required><br><br>
        <button type="submit" name="login">Login</button>
    </form>
    <p>Belum punya akun? <a href="register.php">Daftar</a> | Admin? <a href="login_admin.php">Login Admin</a></p>
</body>
</html>