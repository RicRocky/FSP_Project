<?php

require_once __DIR__ . '/class/Group.php';
require_once "class/Event.php";
require_once "class/Group.php";
require_once "class/Thread.php";
require_once "class/MemberGroup.php";

$group = new Group();
$group->HapusGrup($_GET["idgrup"]);

header("Location: ../ManageGroup.php");