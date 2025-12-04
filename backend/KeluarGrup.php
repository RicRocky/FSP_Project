<?php
session_start();
require_once "class/MemberGroup.php";

$idgrup = $_GET["idgrup"];

$objMemberGroup = new MemberGroup();
$hasil = $objMemberGroup->KeluarGroup($_SESSION["user"], $idgrup);

if($hasil){
    if($_SESSION["role"] == "mahasiswa"){
        header("Location: ../ManageGroupMahasiswa.php");
    }else{
        header("Location: ../ManageGroup.php");
    }
}else{
    header("Location: ../Login.php");
}