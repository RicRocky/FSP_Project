<?php
require_once "backend/class/Group.php";
require_once "backend/class/Akun.php";
require_once "backend/class/Mahasiswa.php";
require_once "backend/class/Dosen.php";
require_once "backend/helper/Pagination.php";

session_start();

$grup = new Group();
$rowGrup = $grup->GetGroup((String) $_GET["idgrup"])->fetch_assoc();

$DATA_PER_PAGE = 10; // Jumlah data

// Pagination mahasiswa
$hal_ke_mahasiswa = isset($_GET['pageMahasiswa']) ? $_GET['pageMahasiswa'] : 1;     // Halaman mahasiswa saat ini
if (!is_numeric($hal_ke_mahasiswa)) {
    header("Location: ManageMemberGrup.php");
}
$offset_mahasiswa = $DATA_PER_PAGE * ($hal_ke_mahasiswa - 1);       // Start Data Mahasiswa

$mahasiswas = new Mahasiswa();
$resMahasiswas = $mahasiswas->GetMahasiswa($DATA_PER_PAGE, $offset_mahasiswa, isset($_GET['cariMahasiswa']) ? $_GET["cariMahasiswa"] : "");
$jumMahasiswas = $mahasiswas->getTotalData($DATA_PER_PAGE, null, isset($_GET['cariMahasiswa']) ? $_GET['cariMahasiswa'] : "");
$hasilMahasiswa = "";
while ($resMahasiswa = $resMahasiswas->fetch_assoc()) {
    $nrpOrNpk = $resMahasiswa["nrp"];
    $username = $resMahasiswa["nama"];
    $foto = $nrpOrNpk . "." . $resMahasiswa["foto_extention"];

    $hasilMahasiswa .= "<tr>";
    $hasilMahasiswa .= "     <td>" . $nrpOrNpk . "</td>";
    $hasilMahasiswa .= "     <td>" . $username . "</td>";
    $hasilMahasiswa .= "     <td> <img src='img/" . $foto . "' alt='-' width='100px'></td>";
    $hasilMahasiswa .= '     <td><button onClick="TambahMember(`' . $resMahasiswa["username"] . '`)">Tambah</button></td>';
    $hasilMahasiswa .= "</tr>";
}

// Pagination Dosen
$hal_ke_dosen = isset($_GET['pageDosen']) ? $_GET['pageDosen'] : 1;     // Halaman dosen saat ini
if (!is_numeric($hal_ke_dosen)) {
    header("Location: ManageMemberGrup.php");
}
$offset_dosen = $DATA_PER_PAGE * ($hal_ke_dosen - 1);   // Start Data Mahasiswa

$dosens = new Dosen();
$resDosens = $dosens->GetDosen($DATA_PER_PAGE, $offset_dosen, isset($_GET["cariDosen"]) ? $_GET["cariDosen"] : "");
$jumDosens = $dosens->getTotalData($DATA_PER_PAGE, null, isset($_GET['cariDosen']) ? $_GET['cariDosen'] : "");
$hasilDosen = "";
while ($row = $resDosens->fetch_assoc()) {
    $nrpOrNpk = $row["npk"];
    $username = $row["nama"];
    $foto = $nrpOrNpk . "." . $row["foto_extension"];

    $hasilDosen .= "<tr>";
    $hasilDosen .= "     <td>" . $nrpOrNpk . "</td>";
    $hasilDosen .= "     <td>" . $username . "</td>";
    $hasilDosen .= "     <td> <img src='img/" . $foto . "' alt='-' width='100px'></td>";
    $hasilDosen .= '     <td><button onClick="TambahMember(`' . $row["username"] . '`)">Tambah</button></td>';
    $hasilDosen .= "</tr>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Member Grup</title>
    <link rel="stylesheet" href="css/template.css">
</head>

<body>
    <main>
        <h1 class="text-center">Pengaturan Member Grup <?php echo $rowGrup["nama"] ?></h1>
        <section class="card">

            <section>
                <h2>Member Saat Ini</h2>
                <table border="1" cellspacing="0" cellpadding="5">
                    <thead>
                        <th>NRP/NPK</th>
                        <th>Username</th>
                        <th>Is Lecturer?</th>
                        <th>Action</th>
                    </thead>
                    <tbody id="tbodyMember">
                    </tbody>
                </table>
            </section>
            <hr>
            <section>
                <h2 style="margin:0;">Daftar Akun</h2>
                <div class="flex">
                    <article class="min-w-50vw align-center">
                        <h3 class="c-judul-table m-0 mt-2">Akun Mahasiswa</h3>
                        <form action="" method="get" class="c-mb-1">
                            <input type="text"
                                value="<?php echo isset($_GET['cariMahasiswa']) ? $_GET['cariMahasiswa'] : "" ?>"
                                name="cariMahasiswa">
                            <input type="text" value="<?php echo 1 ?>" name="pageMahasiswa" hidden>
                            <input type="text" value="<?php echo isset($_GET["cariDosen"]) ? $_GET["cariDosen"] : "" ?>"
                                name="cariDosen" hidden>
                            <input type="text" value="<?php echo $hal_ke_dosen ?>" name="pageDosen" hidden>
                            <input type="text" value="<?php echo $_GET["idgrup"] ?>" name="idgrup" hidden>
                            <button>Cari</button>
                        </form>

                        <table class="mt-1" border="1" cellspacing="0" cellpadding="5">
                            <thead>
                                <tr class="c-thead">
                                    <th>NRP</th>
                                    <th>Name</th>
                                    <th>Photo</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo $hasilMahasiswa; ?>
                            </tbody>
                        </table>
                        <div class="c-mt-2 ">
                            <?php echo GeneratePageNumberMahasiswa(
                                $DATA_PER_PAGE,
                                $jumMahasiswas,
                                $jumDosens,
                                isset($_GET["cariMahasiswa"]) ? $_GET["cariMahasiswa"] : "",
                                $hal_ke_mahasiswa,
                                isset($_GET["cariDosen"]) ? $_GET["cariDosen"] : "",
                                $hal_ke_dosen,
                                $_GET["idgrup"]
                            ) ?>
                        </div>
                    </article>
                    <article class="min-w-50vw align-center">
                        <h3 class="c-judul-table m-0 mt-2">Akun Dosen</h3>
                        <form action="" method="get" class="c-mb-1">
                            <input type="text" value="<?php echo isset($_GET['cariDosen']) ? $_GET['cariDosen'] : "" ?>"
                                name="cariDosen">
                            <input type="text" value="<?php echo $hal_ke_mahasiswa ?>" name="pageMahasiswa" hidden>
                            <input type="text"
                                value="<?php echo isset($_GET["cariMahasiswa"]) ? $_GET["cariMahasiswa"] : "" ?>"
                                name="cariMahasiswa" hidden>
                            <input type="text" value="<?php echo 1 ?>" name="pageDosen" hidden>
                            <input type="text" value="<?php echo $_GET["idgrup"] ?>" name="idgrup" hidden>
                            <button>Cari</button>
                        </form>

                        <table class="mt-1" border="1" cellspacing="0" cellpadding="5">
                            <thead>
                                <tr class="c-thead">
                                    <th>NPK</th>
                                    <th>Name</th>
                                    <th>Photo</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo $hasilDosen; ?>
                            </tbody>
                        </table>
                        <div class="c-mt-2 ">
                            <?php echo GeneratePageNumberDosen(
                                $DATA_PER_PAGE,
                                $jumMahasiswas,
                                $jumDosens,
                                isset($_GET["cariMahasiswa"]) ? $_GET["cariMahasiswa"] : "",
                                $hal_ke_mahasiswa,
                                isset($_GET["cariDosen"]) ? $_GET["cariDosen"] : "",
                                $hal_ke_dosen,
                                $_GET["idgrup"]
                            ) ?>
                        </div>
                    </article>
                </div>
                <br>
                <br>
                <a href="DetailGroup.php?id= <?php echo $_GET["idgrup"] ?>"><button
                        class="btn-back">Kembali</button></a>
            </section>
        </section>
    </main>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    const nodeTbodyMember = $("#tbodyMember");

    $.ajax({
        url: "backend/ManageMemberGrupProcess.php",
        type: "post",
        data: {
            action: "LoadDataDaftarMahasiswaDosen",
            idgrup: <?php echo $_GET["idgrup"] ?>,
        },
        dataType: "json",
        async: false,
        cache: false,
        success: function (data) {
            console.log(data);
            nodeTbodyMember.html("");
            if (data["data"].length == 0) {
                nodeTbodyMember.append(`
                        <tr>
                            <td colspan="4" style="text-align: center;">Belum Terdapat Member.</td>
                        </tr>
                    `)
            } else {
                data["data"].forEach(d => {
                    nodeTbodyMember.append(`
                        <tr>
                            <td>` + ((d['NRP'] != null) ? d["NRP"] : d["NPK"]) + `</td>
                            <td>` + ((d["NamaMahasiswa"] != null) ? d["NamaMahasiswa"] : d["NamaDosen"]) + `</td>
                            <td>` + ((d['NRP'] != null) ? "Tidak" : "Iya") + `</td>
                            <td><button onClick=HapusMember(` + ((d['NRP'] != null) ? d["NRP"] : d["NPK"]) + `)>Hapus</button></td>
                        </tr>
                    `);
                });
            }
        },
        error: function (data) {
            console.log(data);
        },
    });

    function HapusMember(id) {
        $.ajax({
            url: "backend/ManageMemberGrupProcess.php",
            type: "post",
            data: {
                action: "KickMember",
                idgrup: <?php echo $_GET["idgrup"] ?>,
                nrpOrNpk: id,
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function (data) {
                console.log(data);
                nodeTbodyMember.html("");
                if (data["data"].length == 0) {
                    nodeTbodyMember.append(`
                            <tr>
                                <td colspan="4" style="text-align: center;">Belum Terdapat Member.</td>
                            </tr>
                        `)
                } else {
                    data["data"].forEach(d => {
                        nodeTbodyMember.append(`
                            <tr>
                                <td>` + ((d['NRP'] != null) ? d["NRP"] : d["NPK"]) + `</td>
                                <td>` + ((d["NamaMahasiswa"] != null) ? d["NamaMahasiswa"] : d["NamaDosen"]) + `</td>
                                <td>` + ((d['NRP'] != null) ? "Tidak" : "Iya") + `</td>
                                <td><button onClick=HapusMember(` + ((d['NRP'] != null) ? d["NRP"] : d["NPK"]) + `)>Hapus</button></td>
                            </tr>
                        `);
                    });
                }
                alert(data["msg"]);
            },
            error: function (data) {
                console.log(data);
                alert(data["msg"]);
            },
        });
    }

    function TambahMember(username) {
        $.ajax({
            url: "backend/ManageMemberGrupProcess.php",
            type: "post",
            data: {
                action: "TambahMember",
                idgrup: <?php echo $_GET["idgrup"] ?>,
                username: username,
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function (data) {
                console.log(data);
                nodeTbodyMember.html("");
                if (data["data"].length == 0) {
                    nodeTbodyMember.append(`
                            <tr>
                                <td colspan="4" style="text-align: center;">Belum Terdapat Member.</td>
                            </tr>
                        `)
                } else {
                    data["data"].forEach(d => {
                        nodeTbodyMember.append(`
                            <tr>
                                <td>` + ((d['NRP'] != null) ? d["NRP"] : d["NPK"]) + `</td>
                                <td>` + ((d["NamaMahasiswa"] != null) ? d["NamaMahasiswa"] : d["NamaDosen"]) + `</td>
                                <td>` + ((d['NRP'] != null) ? "Tidak" : "Iya") + `</td>
                                <td><button onClick=HapusMember(` + ((d['NRP'] != null) ? d["NRP"] : d["NPK"]) + `)>Hapus</button></td>
                            </tr>
                        `);
                    });
                }
                alert(data["msg"]);
            },
            error: function (data) {
                console.log(data);
            }
        });
    }
</script>

</html>