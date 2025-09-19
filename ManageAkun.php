<!DOCTYPE html>
<html>

<head>
    <title>Create Account</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        .space{
            margin: 10px;
        }
    </style>
</head>
<h1>List Of Accounts</h1>

<body>
    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>NRP/NPK</th>
                <th>Name</th>
                <th>Photo</th>
                <th>Is Lecturer?</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td><a href="#" class="space">Edit</a><a href="#" class="space">Delete</a> </td>
            </tr>   
        </tbody>
        <script>
            $('body').on('change', '#role', function () {
                var selected = $(this).val();
                if (selected == 'dosen') {
                    $("#mahasiswa").hide();
                    $("#dosen").show();
                } else if (selected == 'mahasiswa') {
                    $("#mahasiswa").show();
                    $("#dosen").hide();
                }
            })
        </script>
</body>

</html>