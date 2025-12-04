<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dosen - Membuat Event</title>
    <link rel="stylesheet" href="css/template.css">
</head>

<body>
    <form action="backend/CreateEventProcess.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="idgrup" value="<?php echo $_GET["idgrup"] ?>" hidden>
        <div>
            <label for="judul">Judul:</label>
            <input type="text" name="judul">
        </div>
        <div>
            <label for="judul-slug">Judul Slug:</label>
            <input type="text" name="judulSlug">
        </div>
        <div>
            <label for="tanggal">Tanggal:</label>
            <input type="date" name="tanggal">
        </div>
        <div>
            <label for="keterangan">Keterangan:</label>
            <textarea type="text" name="keterangan"></textarea>
        </div>
        <div>
            <label for="jenis">Jenis:</label>
            <select name="jenis" id="">
                <option value="Publik">Publik</option>
                <option value="Privat">Privat</option>
            </select>
        </div>
        <div>
            <label for="poster">Poster:</label>
            <input type="file" name="poster" accept="image/*">
        </div>
        <button>Buat Event</button>
    </form>
    <?php
        if(isset($_GET["msg"])){
            echo $_GET["msg"];
        }
    ?>
    <br>
    <a href="DetailGroup.php?id=<?php echo $_GET['idgrup'] ?>"><button>Kembali</button></a>
</body>
</html>