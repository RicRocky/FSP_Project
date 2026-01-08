<?php
require_once __DIR__ . '/class/Thread.php';

if (isset($_GET['id']) || $_GET['id'] != "") {
    $id = $_GET['id'];
    $Thread = new Thread();
    $Thread->CloseThread($id);
    header("Location: ../DetailThread.php?id=" . $id . "&closed=1");
    exit;
} else {
    header("Location: ../ManageGroup.php");
}
