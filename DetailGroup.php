<?php
require_once "backend/class/Group.php";
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    die();
}

if (!isset($_GET['id']) && $_SESSION["role"] == "dosen") {
    header("Location: ManageGroup.php");
    die();
}else if(!isset($_GET['id']) && $_SESSION["role"] == "mahasiswa"){
    header("Location: ManageGroupMahasiswa.php");
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
    <h2>Created by <?php foreach ($res as $row) {
        echo $row["username_pembuat"];
    } ?></h2>
    <p>Type: <?php foreach ($res as $row) {
        echo $row["jenis"];
    } ?></p>
    <p>
        Description: <?php
        foreach ($res as $row) {
            echo $row["deskripsi"];
        } ?>
    </p>
    <h3>Registration code: <?php foreach ($res as $row) {
        echo $row["kode_pendaftaran"];
    } ?></h3>
    <table>
        <thead>
            <tr>
                <th>Judul</th>
                <th>Judul-slug</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Jenis</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $mysqli->prepare("SELECT * FROM event");
            $stmt->execute();
            $res = $stmt->get_result();

            while ($row = $res->fetch_assoc()) {
                echo "<tr>";
                echo "<td> " . $row["judul"] . "</td>";
                echo "<td> " . $row["judul-slug"] . "</td>";
                echo "<td> " . $row["tanggal"] . "</td>";
                echo "<td> " . $row["keterangan"] . "</td>";
                echo "<td> " . $row["jenis"] . "</td>";
                if (isset($row["poster-extension"])) {
                    echo "<td><img src='image/" . $row["idevent"] . "." . $rowGambar["poster-extension"] . "' height='75'></td>";
                } else {
                    echo "<td>Tidak ada gambar</td>";
                }
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <?php
    if ($_SESSION['role'] == "dosen") {
        print ('<a href="EditGroup.php?id=' . $_GET['id'] . "&nama=" . $row["nama"] . "&jenis=" . $row["jenis"] . '">Edit group</a>');
    }
    ?>
    <br>
    <a href="ManageGroup.php">Back</a>
</body>

</html>