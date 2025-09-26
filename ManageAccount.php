<?php
require_once "backend/class/Akun.php";
require_once "backend/class/Mahasiswa.php";
require_once "backend/class/Dosen.php";
require_once "backend/helper/Pagination.php";

$DATA_PER_PAGE = 10;
$HALAMAN_KE = isset($_GET['page']) ? $_GET['page'] : 1;
$OFFSET = $DATA_PER_PAGE * ($HALAMAN_KE - 1);   

$akuns = new Akun();
if(isset($_GET['cari'])){
    $resAkun = $akuns->GetAccount($_GET["cari"], $DATA_PER_PAGE, $OFFSET);
}else{
    $resAkun = $akuns->GetAccount("", $DATA_PER_PAGE, $OFFSET);
}

$jumAkuns = $akuns->getTotalData(isset($_GET['cari'])? $_GET['cari']: "");

$hasil = "";
while ($row = $resAkun->fetch_assoc()) {
    $isLecturer = "-";
    $isAdmin = "-";
    $nrpOrNpk = "-";
    $foto = "-";

    if (isset($row["nrp_mahasiswa"])) {
        $nrpOrNpk = $row["nrp_mahasiswa"];

        $mahasiswa = new Mahasiswa();
        $stmtNrpOrNpk = $mahasiswa->GetMahasiswa($nrpOrNpk); 
        $foto = $stmtNrpOrNpk->fetch_assoc()["foto_extention"];
    } else if (isset($row["npk_dosen"])) {
        $isLecturer = "Iya";
        $nrpOrNpk = $row["npk_dosen"];

        $dosen = new Dosen();
        $stmtNrpOrNpk = $dosen->GetDosen($nrpOrNpk); 
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
        .c-mb-1{
            margin-bottom: 0.5rem;
        }
        .c-mt-1{
            margin-top: 0.5rem;
        }
    </style>
</head>

<body>
    <h1>List Of Accounts</h1>
    <form action="" method="get" class="c-mb-1">
        <input type="text" value="<?php echo isset($_GET['cari'])? $_GET['cari']: "" ?>" name="cari">
        <button>Cari</button>
    </form>
    <div>
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
        <div class="c-mt-1">
            <?php echo GeneratePageNumber($DATA_PER_PAGE, $jumAkuns, isset($_GET["cari"])? $_GET["cari"] : "", $HALAMAN_KE) ?>
        </div>
    </div>
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