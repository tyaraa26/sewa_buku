<?php
session_start();
include '../koneksi.php';
if (isset($_POST["login"])) {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' AND role = 'admin'");
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {
            $_SESSION["login"] = true;
            $_SESSION["id_admin"] = $row["id"];
            $_SESSION["nama_admin"] = $row["nama"];
            $_SESSION["role"] = "admin";
            header("Location: ../admin.php");
            exit;
        }
    }
    $error = true;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Login Admin</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h2>Login Panel Admin</h2>
    <?php if (isset($error)) : ?>
        <p style="color: red; font-style: italic;">Username / password salah atau Anda bukan Admin!</p>
    <?php endif; ?>
    <form action="" method="post">
        <input type="text" name="username" placeholder="Username Admin" required><br><br>
        <input type="password" name="password" placeholder="Password Admin" required><br><br>
        <button type="submit" name="login">Login Admin</button>
    </form>
    <p><a href="login_user.php">Kembali ke Login Member</a></p>
</body>
</html>