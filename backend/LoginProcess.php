<?php
session_start();

require_once "class/Akun.php";

// Cek apakah form dikirim
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    //Cek Login
    $akun = new Akun();
    $res = $akun->CheckLogin($username, $password);

    if ($row = $res->fetch_assoc()) {
        // Login berhasil
        $_SESSION['user'] = $row['username'];
        $_SESSION['isadmin'] = $row['isadmin'];

        header("Location: ../Home.php");
    } else {
        // Login gagal
        header("Location: ../login.php?error=Username atau password salah");
    }

} else {
    header("Location: ../login.php?error=Form tidak lengkap");
}
?>