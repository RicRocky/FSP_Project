<?php
require_once __DIR__ . '/class/Akun.php';
require_once __DIR__ . '/class/Mahasiswa.php';
require_once __DIR__ . '/class/Dosen.php';

$akun = new Akun();
$mhs = new Mahasiswa();
$dsn = new Dosen();

if (isset($_GET['id']) && isset($_GET['role']) && isset($_GET['username']) && isset($_GET['ext'])) {
    $id = $_GET['id'];
    $role = $_GET['role'];
    $username = $_GET['username'];
    $ext = $_GET['ext'];

    if ($role === "Iya") {
        $akun->DeleteAkun($username);
        $dsn->DeleteDosen($id);
        $file = __DIR__ . '/../img/' . $id . '.' . $ext;
        if (file_exists($file)) {
            unlink($file);
        }
    } else if ($role == "-") {
        $akun->DeleteAkun($username);
        $mhs->DeleteMahasiswa($id);
        $file = __DIR__ . '/../img/' . $id . '.' . $ext;
        if (file_exists($file)) {
            unlink($file);
        }
    }
    header("Location: ../ManageAccount.php");
    exit;
} else {
    echo "Gagal menghapus akun!";
}

?>