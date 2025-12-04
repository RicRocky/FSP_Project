<?php
require_once "class/Event.php";
require_once "class/Group.php";

$action = $_POST["action"];

if ($action == "LoadDataEvent") {
    echo json_encode([
        "status"    => "Success",
        "msg"       => "Berhasil load event",
        "data"      => LoadDataEvent($_POST["idgrup"]),
    ]);
}else if($action == "LoadDataDaftarMahasiswaDosen"){
    echo json_encode([
        "status"    => "Success",
        "msg"       => "Berhasil load daftar mahasiswa dan dosen yang mengikuti kelas",
        "data"      => LoadDataDaftarMahasiswaDosen($_POST["idgrup"]),
    ]);
}else if ($action == "HapusEvent"){
    HapusEvent($_POST["idevent"]);
    
    echo json_encode([
        "status"    => "Success",
        "msg"       => "Berhasil menghapus event",
        "data"      => LoadDataEvent($_POST["idgrup"]),
    ]);
}

function LoadDataEvent($idgrup)
{
    $event = new Event();
    $resEvent = $event->GetEventGrup($idgrup);

    return $resEvent;
}

function LoadDataDaftarMahasiswaDosen($idgrup){
    $grup = new Group();
    $res = $grup->GetMahasiswaDosenGroup($idgrup);

    return $res;
}

function HapusEvent($idevent){
    $event = new Event();
    $event->DeleteEvent($idevent);
}