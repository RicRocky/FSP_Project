<?php
require_once "backend/class/Group.php";
require_once "backend/class/Thread.php";
require_once "backend/class/Event.php";
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    die();
}

if(!isset($_GET['id']) || $_GET['id'] == "") {
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
    <link rel="stylesheet" href="css/template.css">
</head>

<body>
    <header>
        <nav>
            <a href="ManageThread.php?idgrup=<?php echo $idgrup ?>.php"><button class="btn-back mt-1">Kembali</button></a>
        </nav>
    </header>
    <main>
        <h1 class="mt-5 text-center underline m-0">Detail Thread <?php echo $res["idthread"] ?></h1>
        <p class="text-center m-0">
            Created by <?php echo $res["username_pembuat"] ?> |
            Status: <?php echo $res["status"] ?> |
            Created at: <?php echo $res["tanggal_pembuatan"] ?>
        </p>
        <section class="card mt-5">
            <h2 class="text-bold m-0">Chat:</h2>
            <?php if ($res["username_pembuat"] == $_SESSION["user"]) {
                echo "<a href='backend/CloseThread.php?id=" . $_GET["id"] . "'>Close Thread</a>";
            } ?>
        </section>
    </main>
</body>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<script>
   
</script>

</html>