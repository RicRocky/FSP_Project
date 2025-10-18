<?php
session_start();

if (!isset($_SESSION['user'])) {
    $domain = $_SERVER['HTTP_HOST'];
    $path = $_SERVER['SCRIPT_NAME'];
    $queryString = $_SERVER['QUERY_STRING'];
    $url = "http://" . $domain . $path . "?" . $queryString;

    header("Location: login.php?url=" . $url);
}

if ($_SESSION['isadmin'] == 1) {
    header("Location: ManageAccount.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/pageChangePassword.css">
</head>

<body>
    <main>
        <h2>Ganti Password</h2>
        <section>
            <form action="backend/ChangePasswordProcess.php" method="POST">
                <label>Password Lama:</label><br>
                <input type="password" name="passLama" required><br><br>

                <label>Password Baru:</label><br>
                <input type="password" name="passBaru" required><br><br>

                <label>Konfirmasi Password Baru:</label><br>
                <input type="password" name="konfirmasi" required><br><br>

                <button type="submit">Ganti Password</button>
            </form>
            <?php
            if (isset($_GET['status'])) {
                if ($_GET['status'] == "1") {
                    echo "<p style='color:red;'>Password konfirmasi dan password baru tidak sama.</p>";
                } else {
                    echo "<p style='color:red;'>Terjadi kesalahan saat mengganti password.</p>";
                }
            }
            ?>
        </section>
    </main>
</body>

</html>