<?php
require_once "backend/class/Group.php";
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    die();
}

if (!isset($_GET['id'])) {
    header("Location: ManageGroup.php");
    die();
}

$group = new Group();
$res = $group->GetGroupById($_GET['id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group Details</title>
</head>

<body>
    <h1><?php
    foreach ($res as $row) {
        echo "Group name: " . $row["nama"];
    } ?></h1>
    <h2>Created by <?php foreach ($res as $row) { echo $row["username_pembuat"]; } ?></h2>
    <p>Type: <?php foreach ($res as $row) { echo $row["jenis"]; } ?></p>
    <p>
        Description: <?php
        foreach ($res as $row) {
            echo $row["deskripsi"];
        } ?>
    </p>
    <h3>Registration code: <?php foreach ($res as $row) { echo $row["kode_pendaftaran"]; } ?></h3>
    <?php
    if ($_SESSION['role'] == "dosen") {
        print ('<a href="EditGroup.php?id=' . $_GET['id'] ."&nama=" . $row["nama"] . "&jenis=" . $row["jenis"].'">Edit group</a>');
    }
    ?>
    <br>
    <a href="ManageGroup.php">Back</a>
</body>

</html>