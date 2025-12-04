<?php
require_once "class/MemberGroup.php";

$action = $_POST["action"];

if ($action == "KickMember") {
    $kickResult = KickMember($_POST["nrpOrNpk"], $_POST["idgrup"]);
    if ($kickResult) {
        echo json_encode([
            "status"    => "Success",
            "msg"       => "Berhasil mengeluarkan " . $_POST["nrpOrNpk"],
            "data"      => LoadDataDaftarMahasiswaDosen($_POST["idgrup"]), 
        ]);
    } else {
        echo json_encode([
            "status"    => "Error",
            "msg"       => "Gagal mengeluarkan " . $_POST["nrpOrNpk"] ." karena ". $_POST["nrpOrNpk"] ." pemilik grup",
            "data"      => LoadDataDaftarMahasiswaDosen($_POST["idgrup"]), 
        ]);
    }
}else if($action == "LoadDataDaftarMahasiswaDosen"){
    echo json_encode([
        "status"    => "Success",
        "msg"       => "Berhasil load daftar mahasiswa dan dosen yang mengikuti kelas",
        "data"      => LoadDataDaftarMahasiswaDosen($_POST["idgrup"]),
    ]);
}else if($action == "TambahMember"){
    $res = TambahMember($_POST["username"], $_POST["idgrup"]);
    if($res){
        echo json_encode([
            "status"    => "Success",
            "msg"       => "Berhasil menambah " . $_POST["username"] . " pada kelas",
            "data"      => LoadDataDaftarMahasiswaDosen($_POST["idgrup"]),
        ]);
    }else{
        echo json_encode([
            "status"    => "Error",
            "msg"       => "Gagal menambah " . $_POST["username"] . " pada kelas karena " . $_POST["username"] . " sudah bergabung",
            "data"      => LoadDataDaftarMahasiswaDosen($_POST["idgrup"]),
        ]);
    }
}

function KickMember($nrpOrNpk, $idgrup){
    $memberGroup = new MemberGroup();
    return $memberGroup->KickMember((string)$nrpOrNpk, $idgrup);
}

function LoadDataDaftarMahasiswaDosen($idgrup){
    $grup = new Group();
    $res = $grup->GetMahasiswaDosenGroup($idgrup);

    return $res;
}

function TambahMember($username, $idgrup){
    $memberGrup = new MemberGroup();
    return $memberGrup->AddMemberGroup($username, $idgrup);
}