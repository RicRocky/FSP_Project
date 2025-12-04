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
    <title>Group Details</title>
</head>

<body style="background-color: black; color: white;">
    <main>
        <h1>Group name: <?php echo $res["nama"] ?></h1>
        <section>
            <h2>Created by <?php echo $res["username_pembuat"] ?></h2>
            <p>Type: <?php echo $res["jenis"] ?></p>
            <p>Description: <?php echo $res["deskripsi"]; ?></p>
            <h3>Registration code: <?php echo $res["kode_pendaftaran"] ?></h3>
        </section>
        <?php
        if ($_SESSION["role"] == "mahasiswa") {
            echo "<a href='backend/KeluarGrup.php?idgrup=" . $_GET["id"] . "'>Keluar dari Grup</a>";
        } else if ($res["username_pembuat"] == $_SESSION["user"]) {
            echo "<a href='backend/HapusGrup.php?idgrup=" . $_GET["id"] . "'>Bubarkan dan Hapus Grup</a>";
        }
        ?>
        <section>
            <h2>Daftar Event</h2>
            <hr>
            <table>
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
            <?php
            if ($_SESSION['role'] == "dosen") {
                echo "<a href='CreateEvent.php?idgrup=" . $_GET["id"] . "'>Buat Event</a>";
            }
            ?>
        </section>
        <section>
            <h2>Daftar Mahasiswa/Dosen</h2>
            <hr>
            <table border="1">
                <thead>
                    <tr>
                        <th>NRP/NPK</th>
                        <th>Nama</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody id="tbodyDaftarMember"></tbody>
            </table>
            <a href="ManageMemberGrup.php?idgrup=<?php echo $_GET["id"] ?>">Mengatur Member Grup</a>
        </section>
        <br>
        <br>
        <?php
        if ($_SESSION['role'] == "dosen") {
            echo '<a href="EditGroup.php?id=' . $_GET['id'] . "&nama=" . $res["nama"] . "&jenis=" . $res["jenis"] . '">Edit group</a>';
            echo "<br>";
            echo "<a href='ManageGroup.php'>Back</a>";
        } else if ($_SESSION["role"] == "mahasiswa") {
            echo "<a href='ManageGroupMahasiswa.php'><button>Kembali</button></a>";
        }
        ?>
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
                        <td><a href='EditEvent.php?idevent=` + e["idevent"] + `&idgrup=` + e["idgrup"] + `'><button>Edit</button></a></td>
                        <td><button onClick='HapusEvent(` + e["idevent"] + `)'>Hapus</button></td>
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