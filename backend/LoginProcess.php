<?php
session_start();

require_once "class/Akun.php";

$url = $_POST["url"];

// Cek apakah form dikirim
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];


    //Cek Login
    $akun = new Akun();
    $row = $akun->CheckLogin($username, $password);

    if ($row != null) {
        // Login berhasil
        $_SESSION['user'] = $row['username'];
        $_SESSION['isadmin'] = $row['isadmin'];

        if ($_SESSION['isadmin'] == 0) {
            if ($url == "") {
                header("Location: ../Home.php");
                die();
            } else {
                header("Location: " . $url);
                die();
            }
        } else {
            if ($url == "") {
                header("Location: ../ManageAccount.php");
                die();
            } else {
                header("Location: " . $url);
                die();
            }
        }

    } else {
        // Login gagal
        if ($url == "") {
            header("Location: ../login.php?error=Username atau password salah");
            die();
        } else {
            header("Location: ../login.php?error=Username atau password salah&url=" . $url);
            die();
        }
    }

} else {
    if ($url == "") {
        header("Location: ../login.php?error=Form tidak lengkap");
        die();
    } else {
        header("Location: ../login.php?error=Form tidak lengkap&url=" . $url);
        die();
    }
}
?>