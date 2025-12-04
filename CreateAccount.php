<?php
session_start();
if (!isset($_SESSION['user'])) {
    $domain = $_SERVER['HTTP_HOST'];
    $path = $_SERVER['SCRIPT_NAME'];
    $queryString = $_SERVER['QUERY_STRING'];
    $url = "http://" . $domain . $path . "?" . $queryString;

    header("Location: login.php?url=" . $url);
    die();
}

if ($_SESSION['isadmin'] == 0) {
    header("Location: Home.php");
    die();
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin - Membuat Akun</title>
    <link rel="stylesheet" href="css/pageCreateAccount.css">
    <link rel="stylesheet" href="css/template.css">
</head>

<body>
    <main>
        <section>
            <?php if (isset($_GET['error'])): ?>
                <p class="error">
                    <?php
                    switch ($_GET['error']) {
                        case 'empty_fields':
                            echo " All fields are required!";
                            break;
                        case 'empty_fields_dosen':
                            echo " Please fill all required fields for Dosen!";
                            break;
                        case 'empty_fields_mhs':
                            echo " Please fill all required fields for Mahasiswa!";
                            break;
                        case 'invalid_image':
                            echo " The uploaded file is not a valid image!";
                            break;
                        default:
                            echo " An unknown error occurred.";
                    }
                    ?>
                </p>
            <?php endif; ?>
        </section>

        <section>
            <form action="backend/CreateAccountProcess.php" method="post" enctype="multipart/form-data">
                <p>
                    <label for="role">Pilih Peran:</label>
                    <select name="role" id="role">
                        <option value="dosen">Dosen</option>
                        <option value="mahasiswa">Mahasiswa</option>
                    </select>
                </p>
                <p>
                    <label for="uname">Username:</label>
                    <input type="text" name="uname" />
                </p>
                <p>
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" />
                </p>

                <div id="dosen">
                    <p>
                        <label for="npk">NPK:</label>
                        <input type="text" name="npk" />
                    </p>
                    <p>
                        <label for="name">Name:</label>
                        <input type="text" name="nameDsn" />
                    </p>
                    <p>
                        <label for="imageDsn">Photo:</label>
                        <input type="file" name="imageDsn" id="imageDsn" accept="image/*">
                    </p>
                </div>
                <div id="mahasiswa" class="hidden">
                    <p>
                        <label for="nrp">NRP:</label>
                        <input type="text" name="nrp" />
                    </p>
                    <p>
                        <label for="name">Name:</label>
                        <input type="text" name="nameMhs" />
                    </p>
                    <p>
                        <label for="imageMhs">Photo:</label>
                        <input type="file" name="imageMhs" id="imageMhs" accept="image/*">
                    </p>
                    <p>
                        <label>Gender:</label>
                        <label><input type="radio" name="gender" value="Pria"> Male</label>
                        <label><input type="radio" name="gender" value="Wanita"> Female</label>
                    </p>
                    <p>
                        <label for="birth">Birthday:</label>
                        <input type="date" id="birth" name="birth">
                    </p>
                    <p>
                        <label for="year">Year of:</label>
                        <input type="number" id="year" name="year" min="1900" max="2099" step="1" placeholder="YYYY">
                    </p>
                </div>
                <p>
                    <input type="submit" name="submit" value="Add Account" />
                </p>
            </form>
        </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        $('body').on('change', '#role', function () {
            var selected = $(this).val();
            if (selected == 'dosen') {
                $("#mahasiswa").hide();
                $("#dosen").show();
            } else if (selected == 'mahasiswa') {
                $("#dosen").hide();
                $("#mahasiswa").show();
            }
        });
    </script>
</body>

</html>