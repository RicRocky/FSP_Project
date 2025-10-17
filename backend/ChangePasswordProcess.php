<?php
session_start();
require_once "class/Akun.php"; // koneksi ke DB

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

$username =htmlentities($_SESSION['user']);
$passLama = htmlentities($_POST['passLama']);
$passBaru = htmlentities($_POST['passBaru']);
$konfirmasi = htmlentities($_POST['konfirmasi']);

// cek konfirmasi password
print_r($passLama);
print_r($passBaru);
print_r($konfirmasi);
var_dump($passBaru == $konfirmasi); // false

if ($passBaru !== $konfirmasi) { // true baru jln
    header("Location: ../ChangePassword.php?status=1");
} else {
    $akun = new Akun();
    $res = $akun->GetPass($username);
    if ($row = $res->fetch_assoc()) {
        $pass = $row['password'];
        // cek password lama
        if ($passLama !== $pass) {
            header("Location: ../ChangePassword.php?status=2");
        } else {
            $akun->ChangePass($username, $passBaru);
            header("Location: ../Home.php?status=3");
        }
    }
}

?>