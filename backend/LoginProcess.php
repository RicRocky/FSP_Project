<?php
session_start();

// Koneksi ke database fullstack
$host = "localhost";
$user = "root";       
$pass = "";           
$db   = "fullstack";

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Cek apakah form dikirim
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    //Cek Login
    $stmt = $conn->prepare("SELECT * FROM akun WHERE username = ? AND password = ? LIMIT 1");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($row = $res->fetch_assoc()) {
        // Login berhasil
        $_SESSION['user'] = $row['username'];

        $stmt->close();
        $conn->close();
        header("Location: Home.php");
    } else {
        $stmt->close();
        $conn->close();
        // Login gagal
        header("Location: login.php?error=Username atau password salah");
    }
    
} else {
    $conn->close();
    header("Location: login.php?error=Form tidak lengkap");
}
?>
