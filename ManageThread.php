<?php
require_once "backend/helper/Pagination.php";
require_once "backend/class/Group.php";
require_once "backend/class/Thread.php";

session_start();
if (!isset($_SESSION['user'])) {
    header("Location: Login.php");
}

if ($_SESSION['isadmin'] == 1) {
    header("Location: ManageAccount.php");
}

if (!isset($_GET['idgrup']) || $_GET['idgrup'] == "") {
    header("Location: ManageGroup.php");
}

// Mengecek apakah user saat ini member dari grup 
$group = new Group();
$res = $group->CheckUser($_GET['idgrup'],$_SESSION["user"]);
if (!$res) {
    header("Location: Home.php");
}

$DATA_PER_PAGE = 7;

$hal_ke_Thread = isset($_GET['pageThread']) ? $_GET['pageThread'] : 1;     // Halaman Thread saat ini
if (!is_numeric($hal_ke_Thread)) {
    header("Location: ManageThread.php");
}
$offset_Thread = $DATA_PER_PAGE * ($hal_ke_Thread - 1);       // Start Data Thread

$idgroup = $_GET["idgrup"];
$group = new Group();
$resgroup = $group->GetGroupById($idgroup);
$namagroup = $resgroup["nama"];

$Thread = new Thread();
$res = $Thread->GetThread($idgroup);
$jum = $Thread->getTotalData("");


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thread List</title>
    <link rel="stylesheet" href="css/template.css">
</head>

<body>
    <header>
        <nav>
            <a href="DetailGroup.php?id=<?php echo $_GET["idgrup"]; ?>"><button class="btn-back mt-1">Kembali</button></a>
        </nav>
    </header>
    <main>
        <h1 class="text-center mt-3 underline">List of All Threads in Group <?= $namagroup ?></h1>
        <section class="card mt-5">
            <table border="1" cellspacing="0" cellpadding="5">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Maker</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (count($res) > 0) {
                        foreach ($res as $row) {
                            echo "<tr>";
                            echo "<td>" . $row["idthread"] . "</td>";
                            echo "<td>" . $row["username_pembuat"] . "</td>";
                            echo "<td>" . $row["status"] . "</td>";
                            echo "<td><a href='DetailThread.php?id=" . $row["idthread"] . "'>Detail</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr>";
                        echo "<td colspan='4' class='text-center'>No previous threads</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <a href="backend/CreateThread.php?idgrup=<?= $idgroup ?>&uname=<?= $_SESSION['user'] ?>">Create Thread</a>
        </section>
    </main>
</body>
</html>