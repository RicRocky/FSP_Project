<?php
require_once "backend/class/Akun.php";
require_once "backend/class/Mahasiswa.php";
require_once "backend/class/Dosen.php";

session_start();
if (!isset($_SESSION['user'])) {
    $domain = $_SERVER['HTTP_HOST'];
    $path = $_SERVER['SCRIPT_NAME'];
    $queryString = $_SERVER['QUERY_STRING'];
    $url = "http://" . $domain . $path . "?" . $queryString;
    // http://localhost/fullstack/Project/FSP_Project/EditAccount.php?id=2019001&role=-

    header("Location: login.php?url=" . $url);
    die();
}

if ($_SESSION['isadmin'] == 0) {
    header("Location: Home.php");
    die();
}


$akun = new Akun();
$mhs = new Mahasiswa();
$dsn = new Dosen();

if (isset($_GET['id']) && isset($_GET['role'])) {
    $role = $_GET['role'];

    if ($role == 'Iya') {
        $npk = $_GET['id'];
        $resDsn = $dsn->GetDosen(1, null, $npk)->fetch_assoc();
        $resAkun = $akun->GetAccount($npk, 1, null)->fetch_assoc();
    } else if ($role == '-') {
        $nrp = $_GET['id'];
        $resMhs = $mhs->GetMahasiswa(1, null, $nrp)->fetch_assoc();
        $resAkun = $akun->GetAccount($nrp, 1, null)->fetch_assoc();
    } else {
        header("Location: ManageAccount.php");
        exit;
    }
} else {
    header("Location: ManageAccount.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Account</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="css/pageEditAccount.css">
</head>

<body>
    <main>
        <section>
            <form action="backend/EditAccountProcess.php" method="post" enctype="multipart/form-data">
                <p>
                    <label for="role">Peran:</label>
                    <select id="role" disabled>
                        <option value="Iya" <?php if ($role == 'Iya')
                            echo 'selected'; ?>>Dosen</option>
                        <option value="-" <?php if ($role == '-')
                            echo 'selected'; ?>>Mahasiswa</option>
                    </select>
                    <input type="hidden" name="roleEdit" value="<?php echo $role; ?>">
                </p>
                <p>
                    <label for="uname">Username:</label>
                    <input type="text" name="uname" value="<?php echo $resAkun ? $resAkun['username'] : ''; ?>"
                        disabled />
                    <input type="hidden" name="uname" value="<?php echo $resAkun['username']; ?>">
                </p>
                <p>
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" />
                </p>

                <div id="dosen" <?php if ($role != 'Iya')
                    echo 'class="hidden"'; ?>>
                    <p>
                        <label for="npk">NPK:</label>
                        <input type="text" name="npk" value="<?php echo $resDsn ? $resDsn['npk'] : ''; ?>" disabled />
                        <input type="hidden" name="npk" value="<?php echo $resDsn ? $resDsn['npk'] : ''; ?>">
                    </p>
                    <p>
                        <label for="name">Name:</label>
                        <input type="text" name="nameDsn" value="<?php echo $resDsn ? $resDsn['nama'] : ''; ?>" />
                    </p>
                    <p>
                        <label for="image">Photo:</label>
                        <input type="file" name="imageDsn" id="image" accept="image/*">
                        <?php if ($resDsn && !empty($resDsn['foto_extension'])): ?>
                            <br>
                            <img src="img/<?php echo $resDsn['npk'] . '.' . $resDsn['foto_extension']; ?>" alt="Dosen Photo"
                                width="120" style="margin-top:10px;">
                        <?php endif; ?>
                    </p>
                </div>

                <div id="mahasiswa" <?php if ($role != '-')
                    echo 'class="hidden"'; ?>>
                    <p>
                        <label for="nrp">NRP:</label>
                        <input type="text" name="nrp" value="<?php echo $resMhs ? $resMhs['nrp'] : ''; ?>" disabled />
                        <input type="hidden" name="nrp" value="<?php echo $resMhs ? $resMhs['nrp'] : ''; ?>">
                    </p>
                    <p>
                        <label for="name">Name:</label>
                        <input type="text" name="nameMhs" value="<?php echo $resMhs ? $resMhs['nama'] : ''; ?>" />
                    </p>
                    <p>
                        <label for="image">Photo:</label>
                        <input type="file" name="imageMhs" id="image" accept="image/*">
                        <?php if ($resMhs && !empty($resMhs['foto_extention'])): ?>
                            <br>
                            <img src="img/<?php echo $resMhs['nrp'] . '.' . $resMhs['foto_extention']; ?>" width="120"
                                style="margin-top:10px;">
                        <?php endif; ?>
                    </p>
                    <p>
                        <label>Gender:</label>
                        <label><input type="radio" name="gender" value="Pria" <?php if ($resMhs && $resMhs['gender'] == 'Pria')
                            echo 'checked'; ?>> Male</label>
                        <label><input type="radio" name="gender" value="Wanita" <?php if ($resMhs && $resMhs['gender'] == 'Wanita')
                            echo 'checked'; ?>> Female</label>
                    </p>
                    <p>
                        <label for="birth">Birthday:</label>
                        <input type="date" id="birth" name="birth"
                            value="<?php echo $resMhs ? $resMhs['tanggal_lahir'] : ''; ?>">
                    </p>
                    <p>
                        <label for="year">Year of:</label>
                        <input type="number" id="year" name="year" min="1900" max="2099" step="1" placeholder="YYYY"
                            value="<?php echo $resMhs ? $resMhs['angkatan'] : ''; ?>">
                    </p>
                </div>

                <p>
                    <input type="submit" name="submit" value="Save" />
                </p>
            </form>
        </section>
    </main>
</body>

</html>