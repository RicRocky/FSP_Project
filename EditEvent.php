<?php
require_once "backend/class/Event.php";

$idevent = $_GET["idevent"];
$idgrup = $_GET["idgrup"];

$event = new Event();
$row = $event->GetEvent($idevent);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dosen - Edit Event</title>
    <link rel="stylesheet" href="css/template.css">
</head>

<body>
    <form action="backend/EditEventProcess.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="idgrup" value="<?php echo $_GET["idgrup"] ?>" hidden>
        <input type="text" name="idevent" value="<?php echo $_GET["idevent"] ?>" hidden>
        <input type="text" name="poster_extension" value="<?php echo $row["poster_extension"] ?>" hidden>
        <div>
            <label for="judul">Judul:</label>
            <input type="text" name="judul" value="<?php echo $row["judul"] ?>">
        </div>
        <div>
            <label for="judul-slug">Judul Slug:</label>
            <input type="text" name="judulSlug" value="<?php echo $row["judul-slug"] ?>">
        </div>
        <div>
            <label for="tanggal">Tanggal:</label>
            <input type="date" name="tanggal" value="<?php echo date('Y-m-d', strtotime($row["tanggal"])); ?>">
        </div>
        <div>
            <label for="keterangan">Keterangan:</label>
            <textarea type="text" name="keterangan"><?php echo $row["keterangan"] ?></textarea>
        </div>
        <div>
            <label for="jenis">Jenis:</label>
            <select name="jenis" id="">
                <option value="Publik" <?php if ($row["jenis"] == "Publik") echo "Selected" ?>>Publik</option>
                <option value="Privat" <?php if ($row["jenis"] == "Privat") echo "Selected" ?>>Privat</option>
            </select>
        </div>
        <div>
            <label for="poster">Poster:</label>
            <input type="file" name="poster" accept="image/*">
        </div>
        <?php 
            echo "<div>";
            echo "<p>Poster Lama:</p>";
            echo "<img src='img/". $idevent . "." . $row['poster_extension'] ."' width='150'>";
            echo "</div>";
        ?>
        <button>Edit Event</button>
    </form>
    <?php
    if (isset($_GET["msg"])) {
        echo $_GET["msg"];
    }
    ?>
    <br>
    <a href="DetailGroup.php?id=<?php echo $_GET['idgrup'] ?>"><button>Kembali</button></a>
</body>

</html>