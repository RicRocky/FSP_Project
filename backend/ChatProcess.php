<?php
require_once "class/Thread.php";

session_start();
$action = $_POST["action"];

if ($action == "LoadDataChat") {
    $hasil = LoadDataChat($_POST["idThread"], $_SESSION['user']);
    if($hasil == 0){
        echo json_encode([
            "status" => "Error",
            "msg" => "Anda bukan member thread",
        ]);
    }else{
        echo json_encode([
            "status" => "Success",
            "msg" => "Berhasil load data chat",
            "data" => $hasil,
        ]);
    }
}

function LoadDataChat($idThread, $username)
{
    $objThread = new Thread();
    return $objThread->BacaChatThread($idThread, $username);
}