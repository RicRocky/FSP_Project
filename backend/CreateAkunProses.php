<?php
$mysqli = new mysqli("localhost", "root", "", "movie");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
}

if (isset($_POST['submit'])) {
    $judul = $_POST['judul'];
    $rilis = $_POST['rilis'];
    $skor = $_POST['skor'];
    $sinopsis = $_POST['sinopsis'];
    $serial = $_POST['serial'];
    $genre = $_POST['genre'];


    $image = $_FILES['image'];

    $idpemain = $_POST['idpemain'];
    $peran = $_POST['peran'];


    //insert movie
    $stmt = $mysqli->prepare("INSERT INTO movie (judul, rilis, skor, sinopsis, serial) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param('ssdsi', $judul, $rilis, $skor, $sinopsis, $serial);
    $stmt->execute();
    $jumlah_yang_dieksekusi = $stmt->affected_rows;
    $last_id = $stmt->insert_id;

    //insert image
    for ($i = 0; $i < count($image['name']); $i++) {
        $file_info = getimagesize($_FILES['image']['tmp_name'][$i]);
        if (empty($file_info)) {
            exit("Invalid image file");
        } else {
            $ext = pathinfo($image['name'][$i], PATHINFO_EXTENSION);

            $stmtGambar = $mysqli->prepare("INSERT INTO gambar(extension, idmovie) VALUES (?, ?)");

            $stmtGambar->bind_param('si', $ext, $last_id);
            $stmtGambar->execute();
            $insert_id_gambar = $stmtGambar->insert_id;

            $newFileName = $insert_id_gambar . '.' . $ext;
            move_uploaded_file($_FILES['image']['tmp_name'][$i], 'img/' . $newFileName);
        }
    }

    foreach ($genre as $value) {
        $stmtGenre = $mysqli->prepare("INSERT INTO genre_movie (idmovie, idgenre) VALUES (?, ?)");
        $stmtGenre->bind_param('ii', $last_id, $value);
        $stmtGenre->execute();
    }

    //insert pemain
    for($i =0; $i<count($idpemain); $i++){
        $stmtPemain = $mysqli->prepare("INSERT INTO detail_pemain (idpemain, idmovie, peran) VALUES (?, ?, ?)");
        $stmtPemain->bind_param('iis', $idpemain[$i], $insert_id, $peran[$i]);
        $stmtPemain->execute();
    }

    $stmt->close();
    $mysqli->close();
    header("Location: index.php");
}
?>