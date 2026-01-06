<?php
session_start();
if (isset($_SESSION['isadmin']) && $_SESSION['isadmin'] == 0) {
    header("Location: Home.php");
} else if (isset($_SESSION['isadmin']) && $_SESSION['isadmin'] == 1) {
    header("Location: ManageAccount.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/template.css">
</head>

<body>
    <h2>Form Login</h2>

    <?php echo isset($_GET["error"]) ? $_GET["error"] : "" ?>
    <form method="post" action="backend/LoginProcess.php" class="form-login">
        <div>
            <label>Username:</label>
            <input type="text" name="username" class="w-full" required><br>
        </div>
        <br>
        <div>
            <label class="c-lpass">Password:</label>
            <input type="password" name="password" class="w-full" required><br>
        </div>
        <input type="text" name="url" value="<?php echo isset($_GET['url']) ? $_GET['url'] : "" ?>" hidden>
        <button type="submit" class="mt-2 btn">Login</button>
    </form>
</body>

</html>