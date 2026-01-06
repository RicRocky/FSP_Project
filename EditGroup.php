<?php
require_once "backend/class/Group.php";

session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    die();
} else if ($_SESSION['role'] == "mahasiswa") {
    header("Location: Home.php");
    die();
}

if ($_SESSION['isadmin'] == 1) {
    header("Location: ManageAccount.php");
}

if (!isset($_GET['id'])) {
    header("Location: ManageGroup.php");
    die();
} else {
    $id = $_GET['id'];
    $nama = $_GET['nama'];
    $jenis = $_GET['jenis'];
}

// Mengecek apakah user saat ini member dari grup 
$group = new Group();
$res = $group->CheckUser($_GET['id'],$_SESSION["user"]);
if (!$res) {
    header("Location: Home.php");
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
    <main>
        <a href='DetailGroup.php?id=<?php echo $_GET["id"]; ?>'><button class='btn-back'>Back</button></a>
        <h1 class="text-center underline">Edit Group</h1>  
        <section class="card">
            
            <form method="post" action="backend/EditGroupProcess.php">
                <label>Group name:</label>
                <input type="text" name="groupName" value="<?php echo $nama; ?>" required><br>
                <br>
                <label>Type:</label>
                <select name="groupType">
                    <option value="Publik" <?php echo $jenis == "Publik" ? "selected" : ""; ?>>Public</option>
                    <option value="Privat" <?php echo $jenis == "Privat" ? "selected" : ""; ?>>Private</option>
                </select><br>
                <input type="text" name="id" value="<?php echo $id; ?>" hidden>
                <button type="submit" name="submit" class="btn mt-2">Save changes</button>
            </form>
        </section>
    </main>
</body>

</html>