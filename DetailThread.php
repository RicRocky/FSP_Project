<?php
require_once "backend/class/Group.php";
require_once "backend/class/Thread.php";
require_once "backend/class/Event.php";
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    die();
}

if (!isset($_GET['id']) || $_GET['id'] == "") {
    header("Location: ManageGroup.php");
    die();
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
        <section class=" tengah">
            <div class="card card-kecil mt-5">
                <div class="container-isi-chat" id="tempatChat">
                    <div>
                        <p class="m-0 pl-1">Kucing</p>
                        <div class="other-chat">
                            <p>pesan</p>
                        </div>
                    </div>
                    <div class="kanan text-right">
                        <p class="m-0 pr-1">Aileen</p>
                        <div class="your-chat">
                            <p>pesan</p>
                        </div>
                    </div>
                </div>
                <div class="tengah">
                    <input type="text" class="input-pesan">
                    <button class="btn">Kirim</button>
                </div>
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

    setInterval(function() {
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
                console.log(data["data"].length);
                console.log(dataChat.length);
                console.log(1);
                if (data["data"].length != dataChat.length){
                    console.log(2);
                    for (let i = dataChat.length; i < data["data"].length; i++){
                        console.log(3);
                        dataChat.push(data["data"][i]);
                        TampilkanChatBaru(data["data"][i]);
                    }
                    console.log(4);
                    
                    console.log(5);
                }
            },
        });
    }, 3000);

    function TampilkanChat(datas) {
        nodeTempatChat.html("");
        if (datas.length == 0) {
            nodeTempatChat.append(`
                <tr>
                <td colspan="4" style="text-align: center;">Belum Bergabung Dengan Grup.</td>
                </tr>
            `)
        } else {
            datas.forEach(function(data) {
                let namaUser = "";
                if (data["namaMahasiswa"] != null){
                    namaUser = data["namaMahasiswa"];  
                }else{
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

    function TampilkanChatBaru(datas) {
        if (datas.length == 0) {
            nodeTempatChat.append(`
                <tr>
                <td colspan="4" style="text-align: center;">Belum Bergabung Dengan Grup.</td>
                </tr>
            `)
        } else {
            datas.forEach(function(data) {
                let namaUser = "";
                if (data["namaMahasiswa"] != null){
                    namaUser = data["namaMahasiswa"];  
                }else{
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
</script>

</html>