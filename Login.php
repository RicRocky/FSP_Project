<?php
session_start();
if (isset($_SESSION['user'])) {
    header("Location: Home.php");
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
    <h2>Form Login</h2>
    
    <form method="post" action="backend/LoginProcess.php">
      <label>Username:</label>
        <input type="text" name="username" required><br>
      <label>Password:</label>
      <input type="password" name="password" required><br>
      <button type="submit">Login</button>
    </form>
</body>
</html>
