<?php
require 'funtions.php';

$showMatkul = query_getData("SELECT * FROM matkul ORDER BY hari ASC");
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="libraries/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="libraries/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <style>
        a:link{
            text-decoration: none;
        }
    body,html {
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
    <title>Daftar</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#option" aria-controls="option"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

    <table border="0" align="center" cellpadding="10" cellspacing="0" style="width: 80%;">
        <thead align="center">
            <tr>
                <th>
                    <h1 class="display-4 font-weight-bolder">Daftar Mata Kuliah</h1>
                </th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>
                        <table align="center" class="table table-bordered table-hover table-striped table-dark" style="align-content: center; font-size: small; width: 95%">
                            <thead>
                                <tr>
                                    <th class="text-info" style="text-align: center;">NO</th>
                                    <th class="text-info" style="text-align: center;">Nama Mata Kuliah</th>
                                    <th class="text-info" style="text-align: center;">Type</th>
                                    <th class="text-info" style="text-align: center;">Hari</th>
                                    <th class="text-info" style="text-align: center;">Jam</th>
                                    <th class="text-info" style="text-align: center;">Ubah</th>
                                    <th class="text-danger" style="text-align: center;">Salah?</th>
                                </tr>
                            </thead>
        
                            <tbody>
                                <?php $a = 1; ?>
                                <?php if (!$showMatkul) {
                                    echo "<tr>
                                    <td colspan='16' style='text-align: center;'>Data Masih Kosong...</td>
                                    </tr>";
                                    }else{
                                        foreach($showMatkul as $row ){
                                            echo "<tr>";
                                            echo "<td style='text-align: center;'>".$a."</td>";
                                            echo "<td>". $row['matkul'] ."</td>";
                                            echo "<td>". $row['jenis'] ."</td>";
                                            echo "<td>". hari($row['hari']) ."</td>";
                                            echo "<td style='text-align: center;'>". $row['waktu'] ."</td>";
                                            echo "<td style='text-align: center;'><a href='ubahJadwalKuliah.php?id=" . $row["idmatkul"] . 
                                                "' class='text-warning'>Pilih</a></td>";
                                            echo "<td style='text-align: center;'><a href='hapus.php?id=" . $row["idmatkul"] . 
                                                "&name=matkul' class='btn btn-sm btn-danger'>Hapus</a></td>";
                                            echo "</tr>";
                                        $a++;}
                                    }?>
                            </tbody>
                        </table>
                </td>
            </tr>
        </tbody>

        <tfoot align="center">
            <tr>
                <td style="font-family: 'Courier New', Courier, monospace; font-size: 10pt"><b>© <?php echo date("M Y")?></b>
                <br>Made with <small class="text-danger">❤</small> for <b>YOU</b> by <a href="https://github.com/agilbudi" class='text-white' target='_blank'>HiDe09</a></td>
            </tr>
        </tfoot>
    </table>
    <script src="js/jquery-3.4.1.slim.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="libraries/moment/moment.min.js"></script>
    <script src="libraries/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>