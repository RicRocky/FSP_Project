<?php
require_once "backend/class/Group.php";
require_once "backend/class/Event.php";
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    die();
}

if (!isset($_GET['id']) || $_GET['id'] == "" && $_SESSION["role"] == "dosen") {
    header("Location: ManageGroup.php");
    die();
} else if (!isset($_GET['id']) || $_GET['id'] == "" && $_SESSION["role"] == "mahasiswa") {
    header("Location: ManageGroupMahasiswa.php");
    die();
}

$group = new Group();
$res = $group->GetGroupById($_GET['id']);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Grup</title>
    <link rel="stylesheet" href="css/template.css">
</head>

<body>
    <main>
        <h1 class="mt-5 text-center underline m-0"><?php echo $res["nama"] ?></h1>
        <p class="text-center m-0">Created by <?php echo $res["username_pembuat"] ?> | Type: <?php echo $res["jenis"] ?>
            | Registration code: <?php echo $res["kode_pendaftaran"] ?></p>
        <p class="text-center m-0 mt-1">
            <?php echo "<a href='backend/KeluarGrup.php?idgrup=" . $_GET["id"] . "'>Keluar dari Grup</a>"; ?>
        </p>
        <section class="card mt-5">
            <h2 class="text-bold m-0">Description:</h2>
            <div class="mt-1 mb-1 min-h-10">
                <p class="m-0"><?php echo $res["deskripsi"]; ?></p>
            </div>
            <?php if ($res["username_pembuat"] == $_SESSION["user"]) {
                echo "<a href='backend/HapusGrup.php?idgrup=" . $_GET["id"] . "'>Bubarkan dan Hapus Grup</a>";
            } ?>
            <hr>
            <section class="mt-2 mb-2">
                <h2 class="m-0">Daftar Event</h2>
                <?php if ($_SESSION['role'] == "dosen") {
                    echo "<a href='CreateEvent.php?idgrup=" . $_GET["id"] . "'>Buat Event</a>";
                } ?>
                <table class="mt-1" border="1" cellspacing="0" cellpadding="5">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Judul-slug</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Jenis</th>
                            <th>Foto</th>
                            <?php
                            if ($_SESSION['role'] == "dosen") {
                                echo "<th>Aksi</th>";
                            }
                            ?>

                        </tr>
                    </thead>
                    <tbody id="tbodyEvent"></tbody>
                </table>
            </section>
            <hr>
            <section class="mt-2 mb-2">
                <h2 class="m-0">Daftar Mahasiswa/Dosen</h2>
                <?php if ($_SESSION['role'] == "dosen") {
                    echo '<a href="EditGroup.php?id=' . $_GET['id'] . "&nama=" . $res["nama"] . "&jenis=" . $res["jenis"] . '">Edit group</a>';
                } ?>;
                <table class="mt-1" border="1" cellspacing="0" cellpadding="5">
                    <thead>
                        <tr>
                            <th>NRP/NPK</th>
                            <th>Nama</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody id="tbodyDaftarMember"></tbody>
                </table>
            </section>
            <hr>
            <section>
                <?php
                if ($_SESSION["user"] == $res["username_pembuat"]) {
                    echo "<h2>Pengaturan Member grup</h2>";
                    echo "<a href='ManageMemberGrup.php?idgrup=" . $_GET["id"] . "'>Mengatur Member Grup</a>";
                }
                ?>
            </section>
            <?php
            if ($_SESSION['role'] == "dosen") {
                echo "<br>";
                echo "<a href='ManageGroup.php'><button class='btn-back'>Back</button></a>";
            } else if ($_SESSION["role"] == "mahasiswa") {
                echo "<br>";
                echo "<a href='ManageGroupMahasiswa.php'><button class='btn-back'>Kembali</button></a>";
            } ?>
        </section>
    </main>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<script>
    const nodeTbodyEvent = $("#tbodyEvent");
    const nodeTbodyDaftarMember = $("#tbodyDaftarMember");
    const isDosen = <?php echo ($_SESSION["role"] == "dosen" ? "true" : "false"); ?>;

    $.ajax({
        url: "backend/ProcessDetailGroup.php",
        type: "post",
        data: {
            action: "LoadDataEvent",
            idgrup: <?php echo $_GET["id"] ?>,
        },
        dataType: "json",
        async: false,
        cache: false,
        success: function (data) {
            TampilkanDataTableEvent(data["data"]);
            console.log(data);
        },
        error: function (data) {
            console.log(data);
        },
    });

    $.ajax({
        url: "backend/ProcessDetailGroup.php",
        type: "post",
        data: {
            action: "LoadDataDaftarMahasiswaDosen",
            idgrup: <?php echo $_GET["id"] ?>
        },
        dataType: "json",
        async: false,
        cache: false,
        success: function (data) {
            TampilkanDataTableDaftarMember(data["data"]);
            console.log(data);
        },
        error: function (data) {
            console.log(data);
        },
    });

    function TampilkanDataTableEvent(datas) {
        nodeTbodyEvent.html("");

        if (datas.length <= 0) {
            nodeTbodyEvent.append("<td colspan='7' style='text-align:center;'>Belum ada Event</td>");
        } else {
            let gambar = "";
            let button = "";
            datas.forEach(function (e) {
                if (e["poster-extension"] !== "") {
                    gambar = `<td><img src='img/` + e["idevent"] + `.` + e["poster_extension"] + `' height='75'></td>`;
                } else {
                    gambar = "<td>Tidak ada gambar</td>";
                }

                if (isDosen) {
                    button = `
                        <td>    
                            <a href='EditEvent.php?idevent=` + e["idevent"] + `&idgrup=` + e["idgrup"] + `'><button>Edit</button></a>
                            <button onClick='HapusEvent(` + e["idevent"] + `)'>Hapus</button>
                        </td>
                    `;
                }

                nodeTbodyEvent.append(`
                        <tr>
                            <td>` + e["judul"] + `</td>
                            <td>` + e["judul-slug"] + `</td>
                            <td>` + e["tanggal"] + `</td>
                            <td>` + e["keterangan"] + `</td>
                            <td>` + e["jenis"] + `</td>
                            `     + gambar + `
                            `     + button + `
                        </tr>
                    `);
            });
        }
    }

    function TampilkanDataTableDaftarMember(datas) {
        nodeTbodyDaftarMember.html("");

        if (datas.length <= 0) {
            nodeTbodyDaftarMember.append("<td colspan='3' style='text-align:center;'>Belum ada Member</td>");
        } else {
            datas.forEach(e => {
                if (e["NRP"] != null) {
                    nodeTbodyDaftarMember.append(`
                            <tr>
                                <td>` + e["NRP"] + `</td>
                                <td>` + e["NamaMahasiswa"] + `</td>
                                <td>Mahasiswa</td>
                            </tr>
                        `);
                } else {
                    nodeTbodyDaftarMember.append(`
                            <tr>
                                <td>` + e["NPK"] + `</td>
                                <td>` + e["NamaDosen"] + `</td>
                                <td>Dosen</td>
                            </tr>
                        `);

                }

            });
        }
    }

    function HapusEvent(idevent) {
        $.ajax({
            url: "backend/ProcessDetailGroup.php",
            type: "post",
            data: {
                action: "HapusEvent",
                idevent: idevent,
                idgrup: <?php echo $_GET["id"] ?>
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function (data) {
                TampilkanDataTableEvent(data["data"]);
                console.log(data);
                alert(data["msg"]);
            },
            error: function (data) {
                console.log(data);
            },
        });
    }
</script>

</html>