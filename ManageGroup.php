<?php
require_once "backend/helper/Pagination.php";
require_once "backend/class/Group.php";

session_start();
if (!isset($_SESSION['user'])) {
    header("Location: Login.php");
}

$DATA_PER_PAGE = 7;

$hal_ke_group = isset($_GET['pageGroup']) ? $_GET['pageGroup'] : 1;     // Halaman group saat ini
if (!is_numeric($hal_ke_group)) {
    header("Location: ManageGroup.php");
}
$offset_group = $DATA_PER_PAGE * ($hal_ke_group - 1);       // Start Data group

$group = new Group();
$res = $group->GetGroup("", $DATA_PER_PAGE, $offset_group);
$jum = $group->getTotalData("");


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Group</title>
</head>

<body>
    <h1>List of All Groups</h1>
    <a href="CreateGroup.php">Create a new group</a>
    <table style="border: 1px solid black;">
        <th>
            <tr>
                <td>
                    Nama
                </td>
                <td>
                    Action
                </td>
            </tr>
        </th>
        <tbody>
            <?php
            foreach ($res as $row) {
                echo "<tr>";
                echo "<td>" . $row["nama"] . "</td>";
                echo "<td><a href='DetailGroup.php?id=" . $row["idgrup"] . "'>Detail</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="Home.php">Back</a>
</body>

</html>