<?php
require_once "backend/class/Group.php";
session_start();

if ($_SESSION['isadmin'] == 1) {
    header("Location: ManageAccount.php");
}

$group = new Group();
$res = $group->CheckUser($_GET['idgrup'], $_SESSION["user"]);
if (!$res) {
    header("Location: Home.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dosen - Membuat Event</title>
    <link rel="stylesheet" href="css/template.css">
</head>

<body>
    <main>
        <a href="DetailGroup.php?id=<?php echo $_GET['idgrup'] ?>"><button class="btn-back">Kembali</button></a>
        <h1 class="text-center underline">Membuat Event</h1>
        <section class="card">
            <form action="backend/CreateEventProcess.php" method="POST" enctype="multipart/form-data">
                <input type="text" name="idgrup" value="<?php echo $_GET["idgrup"] ?>" hidden>
                <div class="mb-1">
                    <label for="judul">Judul:</label>
                    <br>
                    <input class="w-full" type="text" name="judul">
                </div>
                <div class="mb-1">
                    <label for="judul-slug">Judul Slug:</label>
                    <br>
                    <input type="text" name="judulSlug">
                </div>
                <div class="mb-1">
                    <label for="tanggal">Tanggal:</label>
                    <input type="date" name="tanggal">
                </div>
                <div class="mb-1">
                    <label for="keterangan">Keterangan:</label>
                    <br>
                    <textarea type="text" name="keterangan"></textarea>
                </div>
                <div class="mb-1">
                    <label for="jenis">Jenis:</label>
                    <select name="jenis" id="">
                        <option value="Publik">Publik</option>
                        <option value="Privat">Privat</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="poster">Poster:</label>
                    <br>
                    <input type="file" name="poster" accept="image/*">
                </div>
                <button class="btn">Buat Event</button>
            </form>
            <?php
            if (isset($_GET["msg"])) {
                echo $_GET["msg"];
            }
            ?>
        </section>
    </main>
</body>

</html>