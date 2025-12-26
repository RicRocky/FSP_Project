<?php
require_once __DIR__ . '/class/Akun.php';
require_once __DIR__ . '/class/Mahasiswa.php';
require_once __DIR__ . '/class/Dosen.php';

if (isset($_POST['submit'])) {
    $role = htmlentities($_POST['role']) ?? '';
    $username = htmlentities($_POST['uname']) ?? '';
    $password = password_hash(htmlentities($_POST['password']) ?? '', PASSWORD_DEFAULT);

    if ($role == '' || $username == '' || $password == '') {
        header("Location: ../CreateAccount.php?error=empty_fields");
        exit;
    }

    if ($role == 'dosen') {
        $npk = htmlentities($_POST['npk']) ?? '';
        $name = htmlentities($_POST['nameDsn']) ?? '';
        $photoDsn = $_FILES['imageDsn'] ?? null;

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
        $akun = new Akun();
        $hasilDosen = $dsn->InsertDosen($npk, $name, $ext);
        if ($hasilDosen == "Npk sudah ada") {
            header("Location: ../CreateAccount.php?error=NPK sudah ada");
            die();
        }

        $hasilAkun = $akun->InsertAkun($username, $password, 0, 0, $npk);
        if ($hasilAkun == "username sudah ada") {
            header("Location: ../CreateAccount.php?error=username sudah ada");
            die();
        }

        $newFileName = $npk . '.' . $ext;
        move_uploaded_file($photoDsn['tmp_name'], __DIR__ . '/../img/' . $newFileName);

    } elseif ($role === 'mahasiswa') {
        $nrp = trim($_POST['nrp']) ?? '';
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
        $akun = new Akun();
        $hasil = $mhs->InsertMahasiswa($nrp, $name, $gender, $birth, $year, $ext);
        if ($hasil == "nrp sudah ada") {
            var_dump($hasil);
            die();
            header("Location: ../CreateAccount.php?error=NRP sudah ada");
            die();
        }

        $hasil = $akun->InsertAkun($username, $password, 0, $nrp, 0);
        if ($hasil == "username sudah ada") {
            header("Location: ../CreateAccount.php?error=username sudah ada");
            die();
        }

        $newFileName = $nrp . '.' . $ext;
        move_uploaded_file($photoMhs['tmp_name'], __DIR__ . '/../img/' . $newFileName);
    }

    header("Location: ../ManageAccount.php?ms=pindah");
    exit;
}
