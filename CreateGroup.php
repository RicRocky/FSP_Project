<?php
session_start();
if (!isset($_SESSION['user'])) {
    $domain = $_SERVER['HTTP_HOST'];
    $path = $_SERVER['SCRIPT_NAME'];
    $queryString = $_SERVER['QUERY_STRING'];
    $url = "http://" . $domain . $path . "?" . $queryString;

    header("Location: login.php?url=" . $url);
    die();
}

if ($_SESSION['role'] == "mahasiswa") {
    header("Location: Home.php");
    die();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Group</title>
</head>

<body>
    <h1>Create a New Group</h1>
    <form action="backend/CreateGroupProcess.php" method="post" enctype="multipart/form-data">
        <input name="username" type="hidden" value="<?php echo $_SESSION['user']; ?>">
        <label id="name">Group Name:</label>
        <input type="text" id="name" name="groupName" required><br>
        <label id="description">Group Description:</label>
        <input type="text" id="description" name="groupDescription" required><br>
        <label id="jenis">Group Type:</label>
        <select id="jenis" name="groupType" required>
            <option value="Publik">Public</option>
            <option value="Privat">Private</option>
        </select><br>
        <button type="submit" name="submit">Create Group</button>
    </form>
</body>

</html>