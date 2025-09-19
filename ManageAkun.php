<?php
require_once "backend/db/Connection.php";

$con = new Connection();
$stmt = $con->getConnection()->query("SELECT * FROM akun");

$hasil = "";
while ($row = $stmt->fetch_assoc()) {
    $isLecturer = "-";
    $isAdmin = "-";
    $nrpOrNpk = "-";
    $foto = "-";
    if (isset($row["nrp_mahasiswa"])) {
        $nrpOrNpk = $row["nrp_mahasiswa"];

        $stmtNrpOrNpk = $con->getConnection()->query("SELECT foto_extention FROM mahasiswa WHERE nrp = '" . $nrpOrNpk . "'");
        $foto = $stmtNrpOrNpk->fetch_assoc()["foto_extention"];
        
    } else if (isset($row["npk_dosen"])) {
        $isLecturer = "Iya";
        $nrpOrNpk = $row["npk_dosen"];
        
        $stmtNrpOrNpk = $con->getConnection()->query("SELECT foto_extension FROM dosen WHERE npk = '" . $nrpOrNpk . "'");
        $foto = $stmtNrpOrNpk->fetch_assoc()["foto_extension"];
        
    }else{
        $isAdmin = "Iya";
        $nrpOrNpk = "-";
        $foto = "-";
    }

    $hasil .= "<tr>";
    $hasil .= "     <td>" . $nrpOrNpk . "</td>";
    $hasil .= "     <td>" . $row["username"] . "</td>";
    $hasil .= "     <td>" . $foto . "</td>";
    $hasil .= "     <td>" . $isLecturer . "</td>";
    $hasil .= "     <td>" . $isAdmin . "</td>";
    $hasil .= '     <td><a href="#" class="space">Edit</a><a href="#" class="space">Delete</a> </td>';
    $hasil .= "</tr>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <style>
        .space {
            margin: 10px;
        }
    </style>
</head>

<body>
    <h1>List Of Accounts</h1>
    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>NRP/NPK</th>
                <th>Name</th>
                <th>Photo</th>
                <th>Is Lecturer?</th>
                <th>Is Admin?</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php echo $hasil; ?>
        </tbody>
    </table>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $('body').on('change', '#role', function () {
        var selected = $(this).val();
        if (selected == 'dosen') {
            $("#mahasiswa").hide();
            $("#dosen").show();
        } else if (selected == 'mahasiswa') {
            $("#mahasiswa").show();
            $("#dosen").hide();
        }
    })
</script>

</html>