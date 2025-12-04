<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    die();
} else if ($_SESSION['role'] == "mahasiswa") {
    header("Location: Home.php");
    die();
}

if (!isset($_GET['id'])) {
    header("Location: ManageGroup.php");
    die();
} else {
    $id = $_GET['id'];
    $nama = $_GET['nama'];
    $jenis = $_GET['jenis'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dosen - Edit Group</title>
    <link rel="stylesheet" href="css/template.css">
</head>

<body>
    <form method="post" action="backend/EditGroupProcess.php">
        <label>Group name:</label>
        <input type="text" name="groupName" value="<?php echo $nama; ?>" required><br>
        <label>Type:</label>
        <select name="groupType">
            <option value="Publik" <?php echo $jenis == "Publik" ? "selected" : ""; ?>>Public</option>
            <option value="Privat" <?php echo $jenis == "Privat" ? "selected" : ""; ?>>Private</option>
        </select><br>
        <input type="text" name="id" value="<?php echo $id; ?>" hidden>
        <button type="submit" name="submit">Save changes</button>
    </form>
</body>

</html>