<?php
require_once "class/Thread.php";

session_start();
$action = $_POST["action"];

if ($action == "LoadDataChat") {
    $hasil = LoadDataChat($_POST["idThread"], $_SESSION['user']);
    if($hasil == 0){
        echo json_encode([
            "status" => "Error",
            "msg" => "Anda bukan member grup",
        ]);
    }else{
        echo json_encode([
            "status" => "Success",
            "msg" => "Berhasil load data chat",
            "data" => $hasil,
        ]);
    }
}else if($action == "KirimPesan"){
    $hasil = KirimPesan($_POST["idThread"], $_SESSION['user'], $_POST["pesan"]);
    if($hasil == 0){
        echo json_encode([
            "status" => "Error",
            "msg" => "Anda bukan member grup",
        ]);
    }else{
        echo json_encode([
            "status" => "Success",
            "msg" => "Berhasil mengirim pesan",
        ]);
    }
}

function LoadDataChat($idThread, $username)
{
    $objThread = new Thread();
    return $objThread->BacaChatThread($idThread, $username);
}

function KirimPesan($idThread, $username, $pesan){
    $objThread = new Thread();
    return $objThread->KirimPesan($idThread, $username, $pesan);
}