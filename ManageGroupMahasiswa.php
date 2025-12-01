<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/manage-group-mahasiswa.css">
</head>

<body>
    <main>
        <h1>Group</h1>
        <hr>
        <section>
            <h2>Bergabung Group Baru</h2>
            <div>
                <input type="text" id="kodeGroup">
                <button id="btnBergabung">Bergabung</button>
            </div>
        </section>
        <section>
            <h2>Daftar Group Diikuti</h2>
            <table border="1">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Tanggal Pembuatan</th>
                        <th>Jenis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="bodyTable">
                </tbody>
            </table>
        </section>
        <section>
            <h2>Daftar Group Public</h2>
            <table border="1">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Tanggal Pembuatan</th>
                        <th>Jenis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="bodyTablePublic">
                </tbody>
            </table>
        </section>
    </main>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<script>
    const nodeTBody = $("#bodyTable");
    const nodeTBodyPublic = $("#bodyTablePublic");

    $.ajax({
        url: "backend/MahasiswaGroup.php",
        type: "post",
        data: {
            action: "LoadDataGrupMahasiswa",
        },
        dataType: "json",
        async: false,
        cache: false,
        success: function (data) {
            TampilkanDataTableGrupMahasiswa(data["data"]);
            console.log(data);
        },
    })

    $.ajax({
        url: "backend/MahasiswaGroup.php",
        type: "post",
        data: {
            action: "LoadDataGrupPublic",
        },
        dataType: "json",
        async: false,
        cache: false,
        success: function (data) {
            TampilkanDataTableGrupPublic(data["data"]);
            console.log(data);
        },
    })

    $("body").on("click", "#btnBergabung", function () {
        Bergabung($("#kodeGroup").val());
    });


    function KeluarGroup(idgrup) {
        $.ajax({
            url: "backend/MahasiswaGroup.php",
            type: "post",
            data: {
                action: "KeluarDariGrup",
                idgrup: idgrup,
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function (data) {
                if (data["status"] == "Success") {
                    TampilkanDataTableGrupMahasiswa(data["data"]);
                    alert("Berhasil");
                    console.log(data);
                } else {
                    alert(data["msg"]);
                    console.log(data);
                }
            },
        })
    }

    function TampilkanDataTableGrupMahasiswa(datas) {
        nodeTBody.html("");
        if (datas.length == 0) {
            nodeTBody.append(`
            <tr>
            <td colspan="4" style="text-align: center;">Belum bergabung dengan grup.</td>
            </tr>
            `)
        } else {
            datas.forEach(data => {
                nodeTBody.append(`
                    <tr>
                        <td>` + data["nama"] + `</td>
                        <td>` + data["tanggal_pembentukan"] + `</td>
                        <td>` + data["jenis"] + `</td>
                        <td> 
                            <a href="DetailGroup.php?id=` + data["idgrup"] + `"><button>Detail</button></a>
                            <br>
                            <button onClick="KeluarGroup('` + data["idgrup"] + `')">Keluar</button>
                        </td>
                    </tr>
                `);
            });
        }
    }

    function TampilkanDataTableGrupPublic(datas) {
        nodeTBodyPublic.html("");
        if (datas.length == 0) {
            nodeTBodyPublic.append(`
                    <tr>
                        <td colspan="4" style="text-align: center;">Belum bergabung dengan grup.</td>
                    </tr>
                `)
        } else {
            datas.forEach(data => {
                nodeTBodyPublic.append(`
                    <tr>
                    <td>` + data["nama"] + `</td>
                    <td>` + data["tanggal_pembentukan"] + `</td>
                    <td>` + data["jenis"] + `</td>
                    <td> 
                        Kode Pendaftaran:<input type="text" id="kodePendaftaranGrupPublic">
                        <button onClick="Bergabung('')">Tambah</button>
                    </td>
                    </tr>
                `);
            });
        }
    }

    function Bergabung(kodeOrIdGrup) {
        $.ajax({
            url: "backend/MahasiswaGroup.php",
            type: "post",
            data: {
                action: "TambahGrupMahasiswa",
                kodeGroup: $("#kodePendaftaranGrupPublic").val(),
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function (data) {
                if (data["status"] == "Success") {
                    TampilkanDataTableGrupMahasiswa(data["data"]);
                    alert("Berhasil");
                    console.log(data);
                } else {
                    alert(data["msg"]);
                    console.log(data);
                }
            },
        });
    }
</script>

</html>