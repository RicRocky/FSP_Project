<?php
session_start();
require_once "class/MemberGroup.php";
require_once "class/Group.php";

$action = $_POST["action"];

// Pengaturan
if ($action == "TambahGrupMahasiswa") {
    $kodeGroup = $_POST["kodeGroup"];
    TambahGrupMahasiswa($kodeGroup);
} else if ($action == "LoadDataGrupMahasiswa") {
    echo json_encode([
        "status" => "Success",
        "msg" => "Berhasil load seluruh grup mahasiswa",
        "data" => LoadDataGrupMahasiswa(),
    ]);
    exit;
} else if ($action == "KeluarDariGrup") {
    $idgrup = $_POST["idgrup"];
    KeluarDariGrup($idgrup);
} else if ($action == "LoadDataGrupPublic") {
    echo json_encode([
        "status" => "Success",
        "msg" => "Berhasil load seluruh grup public",
        "data" => LoadDataGrupPublic(),
    ]);
    exit;
}

function TambahGrupMahasiswa($kodeGroup)
{
    $objMemberGroup = new MemberGroup();
    $hasil = $objMemberGroup->JoinGroup($_SESSION["user"], $kodeGroup);

    if ($hasil == 0) {
        echo json_encode([
            "status" => "Tidak Terdaftar",
            "msg" => "Kode Pendaftaran tidak dikenalin",
        ]);
        exit;
    } else if ($hasil == 1) {
        echo json_encode([
            "status" => "Sudah Bergabung",
            "msg" => "Anda sudah bergabung ke grup ini",
        ]);
        exit;
    }

    echo json_encode([
        "status" => "Success",
        "msg" => "Berhasil bergabung dengan grup",
        "data" => LoadDataGrupMahasiswa(),
    ]);
    exit;
}

function KeluarDariGrup($idgrup)
{
    $objMemberGroup = new MemberGroup();
    $hasil = $objMemberGroup->KeluarGroup($_SESSION["user"], $idgrup);
    
    if (!$hasil) {
        echo json_encode([
            "status" => "Gagal",
            "msg" => "Tidak dapat keluar dari grup",
        ]);
        exit;
    }
    
    echo json_encode([
        "status" => "Success",
        "msg" => "Anda sudah keluar dari grup ini",
        "data" => LoadDataGrupMahasiswa(),
    ]);
    exit;
}

function LoadDataGrupMahasiswa()
{
    $hasil = [];
    $objGroup = new Group();
    $res = $objGroup->GetGroupMember($_SESSION["user"]);
    while ($row = $res->fetch_assoc()) {
        $hasil[] = $row;
    }
    
    return $hasil;
}

function LoadDataGrupPublic(){
    $hasil = [];
    $objGroup = new Group();
    $res = $objGroup->GetGroupPublik();
    while ($row = $res->fetch_assoc()) {
        $hasil[] = $row;
    }
    
    return $hasil;
}