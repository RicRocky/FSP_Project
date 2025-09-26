<!DOCTYPE html>
<html>

<head>
    <title>Create Account</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>

<body>
    <form action="CreateAccountProcess.php" method="post" enctype="multipart/form-data">
        <p>
            <label for="role">Pilih Peran:</label>
            <select name="role" id="role">
                <option value="">Dosen</option>
                <option value="">Mahasiswa</option>
            </select>
        </p>
        <p>
            <label for="uname">Username:</label>
            <input type="text" name="uname" required />
        </p>
        <p>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required />
        </p>

        <div id="dosen">
            <p>
                <label for="npk">NPK:</label>
                <input type="text" name="npk" required />
            </p>
            <p>
                <label for="name">Name:</label>
                <input type="text" name="name" required />
            </p>
            <p>
                <label for="image">Photo:</label>
                <input type="file" name="image" id="image" required>
            </p>
        </div>
        <div id="mahasiswa" class="hidden">
            <p>
                <label for="nrp">NRP:</label>
                <input type="text" name="nrp" required />
            </p>
            <p>
                <label for="name">Name:</label>
                <input type="text" name="name" required />
            </p>
            <p>
                <label for="image">Photo:</label>
                <input type="file" name="image" id="image" required>
            </p>
            <p>
                <label>Gender:</label>
                <label><input type="radio" name="gender" value="Pria"> Male</label>
                <label><input type="radio" name="gender" value="Wanita"> Female</label>
            </p>
            <p>
                <label for="birth">Birthday:</label>
                <input type="date" id="birth" name="birth" required>
            </p>
            <p>
                <label for="year">Year of:</label>
                <input type="number" id="year" name="year" min="1900" max="2099" step="1" placeholder="YYYY" required>
            </p>
        </div>
        <p>
            <input type="submit" name="submit" value="Save" />
        </p>
    </form>
    <script>
    </script>
</body>

</html>