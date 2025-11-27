<?php
require_once __DIR__ . '/class/Group.php';
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $groupName = $_POST['groupName'];
    $groupType = $_POST['groupType'];

    $Group = new Group();
    $res = $Group->EditGroup($id, $groupName, $groupType);

    header("Location: ../DetailGroup.php?id=" . $id . ".php");
}
?>