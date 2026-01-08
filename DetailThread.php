<?php
require_once "backend/class/Group.php";
require_once "backend/class/Thread.php";
require_once "backend/class/Event.php";

session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    die();
}

if ($_SESSION['isadmin'] == 1) {
    header("Location: ManageAccount.php");
}

if (!isset($_GET['id']) || $_GET['id'] == "") {
    header("Location: ManageGroup.php");
    die();
}

$group = new Group();
$res = $group->CheckUserDariIDThread($_GET['id'], $_SESSION["user"]);
if (!$res) {
    header("Location: Home.php");
}

$id = $_GET['id'];
$Thread = new Thread();
$res = $Thread->GetThreadById($id);
$resgrup = $Thread->GetGroupId($id);
$idgrup = $resgrup["idgrup"];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Thread</title>
    <link rel="stylesheet" href="css/template.css?v=1">
</head>

<body>
    <?php if (isset($_GET["closed"])) { ?>
        <script>
            alert("Thread has been closed");
        </script>
    <?php } ?>
    <header>
        <nav>
            <a href="ManageThread.php?idgrup=<?php echo $idgrup ?>.php"><button
                    class="btn-back mt-1">Kembali</button></a>
        </nav>
    </header>
    <main>
        <h1 class="mt-5 text-center underline m-0">Detail Thread <?php echo $res["idthread"] ?></h1>
        <p class="text-center m-0">
            Created by <?php echo $res["username_pembuat"] ?> |
            Status: <?php echo $res["status"] ?> |
            Created at: <?php echo $res["tanggal_pembuatan"] ?>
        </p>
        <section class="tengah">
            <div class="card card-kecil mt-5">
                <div class="container-isi-chat" id="tempatChat"></div>
                <?php
                if ($res["status"] == "Open") {
                    echo '
                        <div class="tengah">
                            <input type="text" class="input-pesan" id="pesan">
                            <button class="btn" id="btnKirim" onClick="Kirim()">Kirim</button>
                        </div>
                    ';
                }
                ?>
            </div>
        </section>
        <section>
            <?php if ($res["username_pembuat"] == $_SESSION["user"]) {
                echo "<a href='backend/CloseThread.php?id=" . $_GET["id"] . "'>Close Thread</a>";
            } ?>
        </section>
    </main>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<script>
    const nodeTempatChat = $("#tempatChat");
    const username = "<?php echo $_SESSION['user'] ?>";
    let dataChat = [];

    $.ajax({
        url: "backend/ChatProcess.php",
        type: "post",
        data: {
            action: "LoadDataChat",
            idThread: <?php echo $_GET["id"]; ?>,
        },
        dataType: "json",
        async: false,
        cache: false,
        success: function (data) {
            console.log(data);
            if (data["status"] == "Error") {
                alert(data["msg"]);
                return;
            }
            dataChat = data["data"];
            TampilkanChat(dataChat);
        },
    });

    setInterval(function () {
        $.ajax({
            url: "backend/ChatProcess.php",
            type: "post",
            data: {
                action: "LoadDataChat",
                idThread: <?php echo $_GET["id"]; ?>,
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function (data) {
                console.log(data);
                if (data["status"] == "Error") {
                    alert(data["msg"]);
                    return;
                }
                if (data["data"].length != dataChat.length) {
                    for (let i = dataChat.length; i < data["data"].length; i++) {
                        dataChat.push(data["data"][i]);
                        TampilkanChatBaru(data["data"][i]);
                    }
                }
            },
        });
    }, 3000);

    function TampilkanChat(datas) {
        nodeTempatChat.html("");
        if (datas.length == 0) {
            // nodeTempatChat.append(`
            //     <tr>
            //     <td colspan="4" style="text-align: center;">Belum Bergabung Dengan Grup.</td>
            //     </tr>
            // `)
        } else {
            datas.forEach(function (data) {
                let namaUser = "";
                if (data["namaMahasiswa"] != null) {
                    namaUser = data["namaMahasiswa"];
                } else {
                    namaUser = data["namaDosen"];
                }

                if (data["username"] == username) {
                    nodeTempatChat.append(`
                        <div class="kanan">
                            <p class="m-0 pr-1">` + namaUser + `</p>
                            <div class="your-chat">
                            <p>` + data["isi"] + `</p>
                            </div>
                            </div>
                            `);
                } else {

                    nodeTempatChat.append(`
                        <div>
                            <p class="m-0 pr-1">` + namaUser + `</p>
                            <div class="other-chat">
                                <p>` + data["isi"] + `</p>
                            </div>
                        </div>
                    `)
                }
            });
        }
    }

    function TampilkanChatBaru(data) {
        if (data.length == 0) {
            // nodeTempatChat.append(`
            //     <tr>
            //     <td colspan="4" style="text-align: center;">Belum Bergabung Dengan Grup.</td>
            //     </tr>
            // `)
        } else {
            let namaUser = "";
            if (data.namaMahasiswa != null) {
                namaUser = data.namaMahasiswa;
            } else {
                namaUser = data.namaDosen;
            }

            if (data.username == username) {
                nodeTempatChat.append(`
                    <div class="kanan">
                        <p class="m-0 pr-1">` + namaUser + `</p>
                        <div class="your-chat">
                        <p>` + data.isi + `</p>
                        </div>
                        </div>
                        `);
            } else {

                nodeTempatChat.append(`
                    <div>
                        <p class="m-0 pr-1">` + namaUser + `</p>
                        <div class="other-chat">
                            <p>` + data.isi + `</p>
                        </div>
                    </div>
                `)
            }
        }
    }

    function Kirim() {
        let pesanBaru = $("#pesan").val();
        console.log(pesanBaru);
        $.ajax({
            url: "backend/ChatProcess.php",
            type: "post",
            data: {
                action: "KirimPesan",
                idThread: <?php echo $_GET["id"]; ?>,
                pesan: pesanBaru,
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function (data) {
                console.log(data);
                alert(data["msg"]);
                $("#pesan").val("");
            },
        });
    }
</script>



</html>