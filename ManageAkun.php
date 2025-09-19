<?php
require_once "backend/db/Connection.php";

$con = new Connection();
$stmt = $con->getConnection()->query("SELECT * FROM akun");

$hasil;
while ($row = $stmt->fetch_assoc()) {
    $mahasiswaOrDosen = false;
    $nrpOrNpk;
    if (isset($row["nrp_mahasiswa"])) {
        $nrpOrNpk = $row["nrp_mahasiswa"];

        $stmtNrpOrNpk = $con->getConnection()->query("SELECT * FROM mahasiswa WHERE nrp = '" . $nrpOrNpk . "'");

    } else {
        $mahasiswaOrDosen = true;
        $nrpOrNpk = $row["npk_dosen"];

        $stmtNrpOrNpk = $con->getConnection()->query("SELECT * FROM dosen WHERE npk = '" . $nrpOrNpk . "'");

    }

    $hasil .= "<tr>";
    $hasil .= "     <td>" . $nrpOrNpk . "</td>";
    $hasil .= "     <td>" . $row["username"] . "</td>";
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
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td><a href="#" class="space">Edit</a><a href="#" class="space">Delete</a> </td>
            </tr>
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