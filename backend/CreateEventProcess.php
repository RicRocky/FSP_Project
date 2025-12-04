<?php
session_start();
require_once "class/Event.php";

$idgrup = $_POST["idgrup"];
$judul = $_POST["judul"];
$judulSlug = $_POST["judulSlug"];
$tanggal = $_POST["tanggal"];
$keterangan = $_POST["keterangan"];
$jenis = $_POST["jenis"];

if (!isset($_FILES["poster"])) {
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