<?php
require_once __DIR__ . '/class/Akun.php';
require_once __DIR__ . '/class/Mahasiswa.php';
require_once __DIR__ . '/class/Dosen.php';

if (isset($_POST['submit'])) {
    $role = htmlentities($_POST['roleEdit']);
    $username = htmlentities($_POST['uname']);
    $password =  password_hash(htmlentities($_POST['password']), PASSWORD_DEFAULT);

    $akun = new Akun();

    if ($role == 'Iya') {
        $dsn = new Dosen();
        $npk = htmlentities($_POST['npk']);
        $name = htmlentities($_POST['nameDsn']);

        $resDsn = $dsn->GetDosen(1, null, $npk)->fetch_assoc();
        $resAkun = $akun->GetAccount($npk, 1, null)->fetch_assoc();

        $ext = $resDsn['foto_extension'];

        if (!empty($_FILES['imageDsn']['tmp_name'])) {
            $photoDsn = $_FILES['imageDsn'];
            $file_info = getimagesize($photoDsn['tmp_name']);
            if ($file_info != false) {
                $ext = pathinfo($photoDsn['name'], PATHINFO_EXTENSION);
                $oldFile = __DIR__ . '/../img/' . $npk . '.' . $resDsn['foto_extension'];
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
                $newFileName = $npk . '.' . $ext;
                move_uploaded_file($photoDsn['tmp_name'], __DIR__ . '/../img/' . $newFileName);
            }
        }

        if ($name == '')
            $name = $resDsn['nama'];
        if ($username == '')
            $username = $resAkun['username'];
        if ($password == '')
            $password = $resAkun['password'];

        $akun->UpdateAkun($username, $password, 0, 0, $npk);
        $dsn->UpdateDosen($npk, $name, $ext);

    } else if ($role == '-') {
        $mhs = new Mahasiswa();
        $nrp = htmlentities($_POST['nrp']);
        $name = htmlentities($_POST['nameMhs']);
        $gender = htmlentities($_POST['gender']) ?? '';
        $birth = htmlentities($_POST['birth']) ?? '';
        $year = htmlentities($_POST['year']) ?? '';

        $resMhs = $mhs->GetMahasiswa(1, null, $nrp)->fetch_assoc();
        $resAkun = $akun->GetAccount($nrp, 1, null)->fetch_assoc();

        $ext = $resMhs['foto_extention'];

        if (!empty($_FILES['imageMhs']['tmp_name'])) {
            $photoMhs = $_FILES['imageMhs'];
            $file_info = getimagesize($photoMhs['tmp_name']);
            if ($file_info != false) {
                $ext = pathinfo($photoMhs['name'], PATHINFO_EXTENSION);
                $oldFile = __DIR__ . '/../img/' . $nrp . '.' . $resMhs['foto_extention'];
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
                $newFileName = $nrp . '.' . $ext;
                move_uploaded_file($photoMhs['tmp_name'], __DIR__ . '/../img/' . $newFileName);
            }
        }

        if ($name == '')
            $name = $resMhs['nama'];
        if ($gender == '')
            $gender = $resMhs['gender'];
        if ($birth == '')
            $birth = $resMhs['tanggal_lahir'];
        if ($year == '')
            $year = $resMhs['angkatan'];
        if ($username == '')
            $username = $resAkun['username'];
        if ($password == '')
            $password = $resAkun['password'];

        $akun->UpdateAkun($username, $password, 0, $nrp, 0);
        $mhs->UpdateMahasiswa($nrp, $name, $gender, $birth, $year, $ext);
    }

    header("Location: ../ManageAccount.php");
    exit;
}
