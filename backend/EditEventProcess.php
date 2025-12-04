<?php
session_start();
require_once "class/Event.php";

$idevent = $_POST["idevent"];
$idgrup = $_POST["idgrup"];
$judul = $_POST["judul"];
$judulSlug = $_POST["judulSlug"];
$tanggal = $_POST["tanggal"];
$keterangan = $_POST["keterangan"];
$jenis = $_POST["jenis"];
$poster_ext = $_POST["poster_extension"];

if ($_FILES["poster"]["error"] == 4) {
    $event = new Event();
    $eventid = $event->UpdateEvent($idevent, $idgrup, $_SESSION["user"], $judul, $judulSlug, $tanggal, $keterangan, $jenis, $poster_ext);
    
    if ($eventid == -1) {
        header("Location: ../CreateEvent.php?msg=Anda belum bergabung dengan grup tersebut&idgrup=$idgrup");
        die();
    }
    
    header("Location: ../DetailGroup.php?id=$idgrup ");
} else {
    $poster = $_FILES["poster"];
    $poster_ext = pathinfo($poster["name"], PATHINFO_EXTENSION);
    
    $event = new Event();
    $eventid = $event->UpdateEvent($idevent, $idgrup, $_SESSION["user"], $judul, $judulSlug, $tanggal, $keterangan, $jenis, $poster_ext);

    if ($eventid == -1) {
        header("Location: ../CreateEvent.php?msg=Anda belum bergabung dengan grup tersebut&idgrup=$idgrup&idevent=$idevent");
        die();
    }

    $tempatSimpan = $eventid . "." . $poster_ext;

    move_uploaded_file($poster["tmp_name"], "../img/" . $tempatSimpan);

    header("Location: ../DetailGroup.php?id=$idgrup");
    die();
}