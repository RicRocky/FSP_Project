<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
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
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body>
            <h2>Selamat datang, <?php echo htmlspecialchars($_SESSION['user']); ?></h2>
            <a href="logout.php">Logout</a>
            <br>
            <a href="ChangePassword.php">Ubah Password</a>
        </body>
    </html>
</body>
</html>