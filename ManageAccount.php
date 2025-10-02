<?php
require_once "backend/class/Akun.php";
require_once "backend/class/Mahasiswa.php";
require_once "backend/class/Dosen.php";
require_once "backend/helper/Pagination.php";

session_start();
if (isset($_SESSION['isadmin'])) {
    if ($_SESSION['isadmin'] == 0) {
        header("Location: Login.php");
    }
} else {
    header('Location: Login.php');
}


$DATA_PER_PAGE = 7; // Jumlah data


// Pagination mahasiswa
$hal_ke_mahasiswa = isset($_GET['pageMahasiswa']) ? $_GET['pageMahasiswa'] : 1;     // Halaman mahasiswa saat ini
$offset_mahasiswa = $DATA_PER_PAGE * ($hal_ke_mahasiswa - 1);       // Start Data Mahasiswa

$mahasiswas = new Mahasiswa();
$resMahasiswas = $mahasiswas->GetMahasiswa($DATA_PER_PAGE, $offset_mahasiswa, isset($_GET['cariMahasiswa']) ? $_GET["cariMahasiswa"] : "");
$jumMahasiswas = $mahasiswas->getTotalData($DATA_PER_PAGE, null, isset($_GET['cariMahasiswa']) ? $_GET['cariMahasiswa'] : "");
$hasilMahasiswa = "";
while ($resMahasiswa = $resMahasiswas->fetch_assoc()) {
    $isLecturer = "-";
    $isAdmin = "-";
    $nrpOrNpk = $resMahasiswa["nrp"];
    $username = $resMahasiswa["username"];
    $foto = $nrpOrNpk . "." . $resMahasiswa["foto_extention"];

    $hasilMahasiswa .= "<tr>";
    $hasilMahasiswa .= "     <td>" . $nrpOrNpk . "</td>";
    $hasilMahasiswa .= "     <td>" . $resMahasiswa["username"] . "</td>";
    $hasilMahasiswa .= "     <td> <img src='img/" . $foto . "' alt='-' width='100px'></td>";
    $hasilMahasiswa .= "     <td>" . $isLecturer . "</td>";
    $hasilMahasiswa .= "     <td>" . $isAdmin . "</td>";
    $hasilMahasiswa .= '     <td><a href="EditAccount.php?id=' . $nrpOrNpk . '&role=' . $isLecturer . '" class="space">Edit</a>';
    $hasilMahasiswa .= '         <a href="backend/DeleteAccountProcess.php?id=' . $nrpOrNpk . '&role=' . $isLecturer . '&username=' . $username . '&ext=' . $foto . '" class="space delete-link">Delete</a>
</td>';
    $hasilMahasiswa .= "</tr>";
}


// Pagination Dosen
$hal_ke_dosen = isset($_GET['pageDosen']) ? $_GET['pageDosen'] : 1;     // Halaman dosen saat ini
$offset_dosen = $DATA_PER_PAGE * ($hal_ke_dosen - 1);   // Start Data Mahasiswa

$dosens = new Dosen();
$resDosens = $dosens->GetDosen($DATA_PER_PAGE, $offset_dosen, isset($_GET["cariDosen"]) ? $_GET["cariDosen"] : "");
$jumDosens = $dosens->getTotalData($DATA_PER_PAGE, null, isset($_GET['cariDosen']) ? $_GET['cariDosen'] : "");
$hasilDosen = "";
while ($row = $resDosens->fetch_assoc()) {
    $isLecturer = "Iya";
    $isAdmin = "-";
    $nrpOrNpk = $row["npk"];
    $username = $row["username"];
    $foto = $nrpOrNpk . "." . $row["foto_extension"];

    $hasilDosen .= "<tr>";
    $hasilDosen .= "     <td>" . $nrpOrNpk . "</td>";
    $hasilDosen .= "     <td>" . $row["username"] . "</td>";
    $hasilDosen .= "     <td> <img src='img/" . $foto . "' alt='-' width='100px'></td>";
    $hasilDosen .= "     <td>" . $isLecturer . "</td>";
    $hasilDosen .= "     <td>" . $isAdmin . "</td>";
    $hasilDosen .= '     <td><a href="EditAccount.php?id=' . $nrpOrNpk . '&role=' . $isLecturer . '" class="space">Edit</a>'
        . '<a href="backend/DeleteAccountProcess.php?id=' . $nrpOrNpk .
        '&role=' . $isLecturer .
        '&username=' . $username .
        '&ext=' . $foto .
        '" class="space delete-link">Delete</a>
</td>';
    $hasilDosen .= "</tr>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun</title>
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
    <h2><a href="CreateAccount.php">Buat Akun</a></h2>
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
            <?php echo GeneratePageNumberMahasiswa(
                $DATA_PER_PAGE,
                $jumMahasiswas,
                $jumDosens,
                isset($_GET["cariMahasiswa"]) ? $_GET["cariMahasiswa"] : "",
                $hal_ke_mahasiswa,
                isset($_GET["cariDosen"]) ? $_GET["cariDosen"] : "",
                $hal_ke_dosen
            ) ?>
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
            <?php echo GeneratePageNumberDosen(
                $DATA_PER_PAGE,
                $jumMahasiswas,
                $jumDosens,
                isset($_GET["cariMahasiswa"]) ? $_GET["cariMahasiswa"] : "",
                $hal_ke_mahasiswa,
                isset($_GET["cariDosen"]) ? $_GET["cariDosen"] : "",
                $hal_ke_dosen
            ) ?>
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
    $(".delete-link").click(function () {
        return confirm("Are you sure you want to delete this account?");
    });
</script>

</html>