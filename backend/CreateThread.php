<?php
require_once __DIR__ . '/class/Thread.php';
require_once __DIR__ . '/class/MemberGroup.php';

if (isset($_GET['idgrup']) && $_GET['idgrup'] != "") {
    $uname = $_GET['uname'];
    $idgrup = $_GET['idgrup'];

    $Thread = new Thread();
    $Thread->CreateThread($uname, $idgrup);

    header("Location: ../ManageThread.php?idgrup=" . $idgrup);
}
?>