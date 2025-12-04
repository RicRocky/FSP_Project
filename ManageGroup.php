<?php
require_once "backend/helper/Pagination.php";
require_once "backend/class/Group.php";

session_start();
if (!isset($_SESSION['user'])) {
    header("Location: Login.php");
}

$DATA_PER_PAGE = 7;

$hal_ke_group = isset($_GET['pageGroup']) ? $_GET['pageGroup'] : 1;     // Halaman group saat ini
if (!is_numeric($hal_ke_group)) {
    header("Location: ManageGroup.php");
}
$offset_group = $DATA_PER_PAGE * ($hal_ke_group - 1);       // Start Data group

$group = new Group();
$res = $group->GetGroupUser($_SESSION["user"]);
$jum = $group->getTotalData("");


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dosen -Pengaturan Grup</title>
    <link rel="stylesheet" href="css/template.css">
</head>

<body>
    <header>
        <nav>
            <a href="Home.php"><button class="btn-back mt-1">Kembali</button></a>
        </nav>
    </header>
    <main>
        <h1 class="text-center mt-3 underline">List of All Groups</h1>
        <section class="card mt-5">
            <table border="1" cellspacing="0" cellpadding="5">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($res) > 0) {
                        foreach ($res as $row) {
                            echo "<tr>";
                            echo "<td>" . $row["nama"] . "</td>";
                            echo "<td><a href='DetailGroup.php?id=" . $row["idgrup"] . "'>Detail</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr>";
                        echo "<td colspan='2' class='text-center'>Anda belum bergabung dengan grup</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <a href="CreateGroup.php">Create a new group</a>
        </section>
    </main>
</body>

</html>