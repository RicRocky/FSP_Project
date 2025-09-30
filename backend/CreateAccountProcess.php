<?php
require_once __DIR__ . '/class/Akun.php';
require_once __DIR__ . '/class/Mahasiswa.php';
require_once __DIR__ . '/class/Dosen.php';

if (isset($_POST['submit'])) {
    $role = $_POST['role'] ?? '';
    $username = $_POST['uname'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($role == '' || $username == '' || $password == '') {
        header("Location: ../CreateAccount.php?error=empty_fields");
        exit;
    }

    

    if ($role == 'dosen') {
        $npk = $_POST['npk'] ?? '';
        $name = $_POST['nameDsn'] ?? '';
        $photoDsn = $_FILES['imageDsn'] ?? null;

        $akun = new Akun();
        if ($npk == '' || $name == '' || empty($photoDsn['tmp_name'])) {
            header("Location: ../CreateAccount.php?error=empty_fields_dosen");
            exit;
        }

        $file_info = getimagesize($photoDsn['tmp_name']);
        if ($file_info === false) {
            header("Location: ../CreateAccount.php?error=invalid_image");
            exit;
        }

        $ext = pathinfo($photoDsn['name'], PATHINFO_EXTENSION);

        $dsn = new Dosen();
        $dsn->InsertDosen($npk, $name, $ext);
        $akun->InsertAkun($username, $password, 0, 0, $npk);

        $newFileName = $npk . '.' . $ext;
        move_uploaded_file($photoDsn['tmp_name'], __DIR__ . '/../img/' . $newFileName);

    } elseif ($role === 'mahasiswa') {
        $nrp = $_POST['nrp'] ?? '';
        $name = $_POST['nameMhs'] ?? '';
        $gender = $_POST['gender'] ?? '';
        $birth = $_POST['birth'] ?? '';
        $year = $_POST['year'] ?? '';
        $photoMhs = $_FILES['imageMhs'] ?? null;

        if ($nrp == '' || $name == '' || $gender == '' || $birth == '' || $year == '' || empty($photoMhs['tmp_name'])) {
            header("Location: ../CreateAccount.php?error=empty_fields_mhs");
            exit;
        }

        $file_info = getimagesize($photoMhs['tmp_name']);
        if ($file_info == false) {
            header("Location: ../CreateAccount.php?error=invalid_image");
            exit;
        }

        $ext = pathinfo($photoMhs['name'], PATHINFO_EXTENSION);
      
        $mhs = new Mahasiswa();
        $mhs->InsertMahasiswa($nrp, $name, $gender, $birth, $year, $ext);
        $akun->InsertAkun($username, $password, 0, $nrp, 0);

        $newFileName = $nrp . '.' . $ext;
        move_uploaded_file($photoMhs['tmp_name'], __DIR__ . '/../img/' . $newFileName);
    }

    header("Location: ../ManageAccount.php");
    exit;
}
