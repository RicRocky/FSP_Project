<?php
session_start();
require_once "class/Event.php";

$idgrup = $_POST["idgrup"];

if ($_POST["judul"] == "") {
    header("Location: ../CreateEvent.php?msg='Harap memasukan judul'&idgrup=" . $idgrup);
    die();
}
$judul = $_POST["judul"];

if ($_POST["judulSlug"] == "") {
    header("Location: ../CreateEvent.php?msg='Harap memasukan judul slug'&idgrup=" . $idgrup);
    die();
}
$judulSlug = $_POST["judulSlug"];

if ($_POST["tanggal"] == "") {
    header("Location: ../CreateEvent.php?msg='Harap memasukan tanggal'&idgrup=" . $idgrup);
    die();
}
$tanggal = $_POST["tanggal"];

if ($_POST["keterangan"] == "") {
    header("Location: ../CreateEvent.php?msg='Harap memasukan keterangan'&idgrup=" . $idgrup);
    die();
}
$keterangan = $_POST["keterangan"];

if ($_POST["jenis"] == "") {
    header("Location: ../CreateEvent.php?msg='Harap memasukan jenis'&idgrup=" . $idgrup);
    die();
}
$jenis = $_POST["jenis"];

if ($_FILES["poster"]["error"] == 4) {
    header("Location: ../CreateEvent.php?msg='Harap memasukan poster'&idgrup=" . $idgrup);
    die();
}
$poster = $_FILES["poster"];
$poster_ext = pathinfo($poster["name"], PATHINFO_EXTENSION);

$event = new Event();
$eventid = $event->CreateEvent($idgrup, $_SESSION["user"], $judul, $judulSlug, $tanggal, $keterangan, $jenis, $poster_ext);

if ($eventid == -1) {
    header("Location: ../CreateEvent.php?msg=Anda belum bergabung dengan grup tersebut&idgrup=$idgrup");
    die();
}

$tempatSimpan = $eventid . "." . $poster_ext;

move_uploaded_file($poster["tmp_name"], "../img/" . $tempatSimpan);

header("Location: ../CreateEvent.php?msg=Berhasil menambahkan event $judul&idgrup=$idgrup ");
die();