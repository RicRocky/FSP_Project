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
</head>

<body>
    <h2>Selamat datang, <?php echo $_SESSION['user'] ?></h2>
    <a href="backend/LogoutProcess.php">Logout</a>
    <br>
    <a href="ChangePassword.php">Ubah Password</a>
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