<?php
session_start();
require_once "class/Akun.php"; // koneksi ke DB

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

$username = htmlentities($_SESSION['user']);
$passLama = htmlentities($_POST['passLama']);
$passBaru = htmlentities($_POST['passBaru']);
$konfirmasi = htmlentities($_POST['konfirmasi']);

if ($passBaru !== $konfirmasi) { // true baru jln
    header("Location: ../ChangePassword.php?status=1");
} else {
    $akun = new Akun();
    $res = $akun->GetPass($username);
    if ($row = $res->fetch_assoc()) {
        $is_authenticated = password_verify($passLama, $row["password"]);

        if (!$is_authenticated) {
            header("Location: ../ChangePassword.php?status=2");
        } else {
            $akun->ChangePass($username, $passBaru);
            header("Location: ../Home.php?status=3");
        }
    }
}