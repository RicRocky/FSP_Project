<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    die();
}
if ($_SESSION['isadmin'] == 1) {
    header("Location: ManageAccount.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App - Beranda</title>
    <link rel="stylesheet" href="css/pageHome.css">
    <link rel="stylesheet" href="css/template.css">
</head>

<body>
    <main>
        <h2 class="text-center mt-5 underline">Selamat Datang <?php echo $_SESSION['user'] ?>!!</h2>
        <div>
            <div class="c-card">
                <img src="img/asset/ganti-password.png">
                <p><a href="ChangePassword.php">Ubah Password</a></p>
            </div>
            <?php
            if($_SESSION['role'] == "dosen") {
                echo '<div class="c-card mr-2">
                <img src="img/asset/icon-group1.png">
                <p><a href="ManageGroup.php">Lihat Daftar Group</a></p>
            </div>';
            }
            if($_SESSION['role'] == "mahasiswa") {
                echo '<div class="c-card mr-2">
                <img src="img/asset/icon-group1.png">
                <p><a href="ManageGroupMahasiswa.php">Group</a></p>
            </div>';
            }
            ?>
            <div style="clear:both;"></div>
        </div>
        <section class="">
            <br>
            <p><a href="backend/LogoutProcess.php">Logout</a></p>
        </section>
    </main>
</body>

<script>
    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == "3") {
            echo "alert('Password berhasil diganti!')";
        }
    }
    ?>
</script>

</html>