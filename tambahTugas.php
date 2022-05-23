<?php
include 'funtions.php';
$idmatkul = $_GET["idmatkul"];

if (isset($_POST["submit"])) {
    if (tambahTugas($_POST) > 0) {
        echo "<script>
        document.location.href= 'index.php';
        </script>";
    }else {
        echo "<script>
        alert('Data Gagal Ditambahkan!');
        document.location.href= 'index.php';
        </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="libraries/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="libraries/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <title>Tambah Tugas</title>
    <style>
    body,
    html {
        /* background-image: url("background.jpg");*/  background-image: url("https://images.pexels.com/photos/3751697/pexels-photo-3751697.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940");
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
        color: white;
        height: 100%;
        margin-top: 35px;
    }
    </style>
    <script>
    document.getElementById("title_hover").innerHTML = "Test";
    </script>
</head>

<body>
    <h1 class="display-3" align="center">Tambah Tugas</h1>
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#option" aria-controls="option"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="option">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <!-- <span class="nav-link" href="tambahJadwal.php">Tambah Matkul<span class="sr-only">(current)</span></a> -->
                </li>
            </ul>
        </div>
    </nav>

    <div class="container" style="height: 100%;" align="center">
        <table border="0" style="width: 50%;">
            <thead style="height: 5%" align="center">
                <tr style="height: 10%">
                    <td>
                        <h2> </h2>
                    </td>
                </tr>
            </thead>
            <tbody align="center">
                <tr style="height: 70%">
                    <td>
                        <form method="post" action="" align="left"
                            style="width: 80%; padding: 20px; border: 0px solid #f1f1f1; background-color: rgba(0, 0, 51, 0.2);">
                            <input class="form-control" type="hidden" name="idmatkul" value="<?= $idmatkul ?>">
                            <div class="form-group">
                                <input type="namespace" class="form-control" id="matkul" name="namaTugas"
                                    placeholder="Nama Tugas" required>
                            </div>
                            <br />
                            <div class="form-group">
                                <input type="namespace" class="form-control" id="link" name="link"
                                    placeholder="Paste Link - Tugas" required>
                            </div>
                            <div align="right">
                                <button type="submit" class="btn btn-dark" name="submit">Tambah</button>
                            </div>
                        </form>
                    </td>
                </tr>
                <tr>
                    <td></td>
                </tr>
            </tbody>
            <tfoot style="height: 5%;" align="center">
            <tr>
                <td style="font-family: 'Courier New', Courier, monospace; font-size: 10pt"><b>© <?php echo date("M Y")?></b>
                <br>Made with <small class="text-danger">❤</small> for <b>YOU</b> by <a href="https://github.com/agilbudi" class='text-white' target='_blank'>HiDe09</a></td>
            </tr>
            </tfoot>
        </table>
    </div>



    <script src="js/jquery-3.4.1.slim.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="libraries/moment/moment.min.js"></script>
    <script src="libraries/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="js/custom.js"></script>
    <script>
    $(document).ready(function() {
        setDatePicker()
        setDateRangePicker(".startdate", ".enddate")
        setMonthPicker()
        setYearPicker()
        setYearRangePicker(".startyear", ".endyear")
    })
    </script>
</body>

</html>