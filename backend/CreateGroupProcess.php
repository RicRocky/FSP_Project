<?php
require_once __DIR__ . '/class/Group.php';
require_once __DIR__ . '/class/MemberGroup.php';
if (isset($_POST['submit'])) {
    $groupName = $_POST['groupName'];
    $groupDescription = $_POST['groupDescription'];
    $groupType = $_POST['groupType'];
    $pembuat = $_POST['username'];
    $tgl = date('Y-m-d H:i:s');

    $Group = new Group();
    $Group->InsertGroup($pembuat, $groupName, $groupDescription, $tgl, $groupType);

    header("Location: ../ManageGroup.php");
}
?>