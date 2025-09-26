<?php
require_once "backend/class/Akun.php";
require_once "backend/class/Mahasiswa.php";
require_once "backend/class/Dosen.php";
require_once "backend/helper/Pagination.php";

$DATA_PER_PAGE = 5;

$hal_ke_mahasiswa = isset($_GET['pageMahasiswa']) ? $_GET['pageMahasiswa'] : 1;
$hal_ke_dosen = isset($_GET['pageDosen']) ? $_GET['pageDosen'] : 1;
if($hal_ke_dosen <= 0) {
    $hal_ke_dosen = 1;
}

$offset_mahasiswa = $DATA_PER_PAGE * ($hal_ke_mahasiswa - 1);
$offset_dosen = $DATA_PER_PAGE * ($hal_ke_dosen - 1);

$mahasiswas = new Mahasiswa();
$dosens = new Dosen();

if (isset($_GET['cariMahasiswa'])) {
    $resMahasiswas = $mahasiswas->GetMahasiswa($DATA_PER_PAGE, $offset_mahasiswa, $_GET["cariMahasiswa"]);
} else {
    $resMahasiswas = $mahasiswas->GetMahasiswa($DATA_PER_PAGE, $offset_mahasiswa);
}

if (isset($_GET['cariDosen'])) {
    $resDosens = $dosens->GetDosen($DATA_PER_PAGE, $offset_dosen, isset($_GET["cariDosen"]) ? $_GET["cariDosen"] : "");
} else {
    $resDosens = $dosens->GetDosen($DATA_PER_PAGE, $offset_dosen);
}

$jumMahasiswas = $mahasiswas->getTotalData($DATA_PER_PAGE, null, isset($_GET['cariMahasiswa']) ? $_GET['cariMahasiswa'] : "");
$jumDosens = $dosens->getTotalData($DATA_PER_PAGE, null, isset($_GET['cariDosen']) ? $_GET['cariDosen'] : "");

$hasilMahasiswa = "";
while ($row = $resMahasiswas->fetch_assoc()) {
    $isLecturer = "-";
    $isAdmin = "-";
    $nrpOrNpk = $row["nrp"];
    $foto = $row["foto_extention"];

    $hasilMahasiswa .= "<tr>";
    $hasilMahasiswa .= "     <td>" . $nrpOrNpk . "</td>";
    $hasilMahasiswa .= "     <td>" . $row["username"] . "</td>";
    $hasilMahasiswa .= "     <td>" . $foto . "</td>";
    $hasilMahasiswa .= "     <td>" . $isLecturer . "</td>";
    $hasilMahasiswa .= "     <td>" . $isAdmin . "</td>";
    $hasilMahasiswa .= '     <td><a href="#" class="space">Edit</a><a href="#" class="space">Delete</a> </td>';
    $hasilMahasiswa .= "</tr>";
}

$hasilDosen = "";
while ($row = $resDosens->fetch_assoc()) {
    $isLecturer = "Iya";
    $isAdmin = "-";
    $nrpOrNpk = $row["npk"];
    $foto = $row["foto_extension"];

    $hasilDosen .= "<tr>";
    $hasilDosen .= "     <td>" . $nrpOrNpk . "</td>";
    $hasilDosen .= "     <td>" . $row["username"] . "</td>";
    $hasilDosen .= "     <td>" . $foto . "</td>";
    $hasilDosen .= "     <td>" . $isLecturer . "</td>";
    $hasilDosen .= "     <td>" . $isAdmin . "</td>";
    $hasilDosen .= '     <td><a href="#" class="space">Edit</a><a href="#" class="space">Delete</a> </td>';
    $hasilDosen .= "</tr>";
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

        .c-mb-1 {
            margin-bottom: 0.5rem;
        }

        .c-mt-1 {
            margin-top: 0.5rem;
        }
    </style>
</head>

<body>
    <h1>Akun Mahasiswa</h1>
    <form action="" method="get" class="c-mb-1">
        <input type="text" value="<?php echo isset($_GET['cariMahasiswa']) ? $_GET['cariMahasiswa'] : "" ?>"
            name="cariMahasiswa">
        <button>Cari</button>
    </form>
    <div>
        <table border="1" cellspacing="0" cellpadding="5">
            <thead>
                <tr>
                    <th>NRP</th>
                    <th>Name</th>
                    <th>Photo</th>
                    <th>Is Lecturer?</th>
                    <th>Is Admin?</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $hasilMahasiswa; ?>
            </tbody>
        </table>
        <div class="c-mt-1">
            <?php echo GeneratePageNumber($DATA_PER_PAGE, $jumMahasiswas, $jumDosens, isset($_GET["cariMahasiswa"]) ? $_GET["cariMahasiswa"] : "", $hal_ke_mahasiswa, isset($_GET["cariDosen"]) ? $_GET["cariDosen"] : "", $hal_ke_dosen) ?>
        </div>
    </div>

    <h1>Akun Dosen</h1>
    <form action="" method="get" class="c-mb-1">
        <input type="text" value="<?php echo isset($_GET['cariDosen']) ? $_GET['cariDosen'] : "" ?>" name="cariDosen">
        <button>Cari</button>
    </form>
    <div>
        <table border="1" cellspacing="0" cellpadding="5">
            <thead>
                <tr>
                    <th>NRP</th>
                    <th>Name</th>
                    <th>Photo</th>
                    <th>Is Lecturer?</th>
                    <th>Is Admin?</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $hasilDosen; ?>
            </tbody>
        </table>
        <div class="c-mt-1">
            <?php echo GeneratePageNumber($DATA_PER_PAGE, $jumMahasiswas, $jumDosens, isset($_GET["cariMahasiswa"]) ? $_GET["cariMahasiswa"] : "", $hal_ke_mahasiswa, isset($_GET["cariDosen"]) ? $_GET["cariDosen"] : "", $hal_ke_dosen) ?>
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