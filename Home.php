<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    die();
}
if ($_SESSION['isadmin']) {
    header("Location: ManageAccount.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/pageHome.css">
</head>

<body>
    <main>
        <h2>Selamat Datang <span class="c-susername"><?php echo $_SESSION['user'] ?></span>!!</h2>
        <section class="c-card">
            <img src="img/asset/ganti-password.png">
            <p><a href="ChangePassword.php">Ubah Password</a></p>
        </section>
        <section class="">
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