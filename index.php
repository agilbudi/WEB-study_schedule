<?php
require 'funtions.php';

$showUAS = query_getData("SELECT * FROM uas ORDER BY tanggal ASC");
$showUTS = query_getData("SELECT * FROM uts ORDER BY tanggal ASC");
$showMatkul = query_getData("SELECT * FROM matkul ORDER BY hari,waktu ASC");
function joinTugas($idmatkul)
{
    $sqljoin = "SELECT tugas.idtugas,tugas.namaTugas,tugas.link,matkul.jenis, matkul.linkmedia
                    FROM tugas INNER JOIN matkul   
                    ON tugas.idmatkul = matkul.idmatkul
                    WHERE tugas.idmatkul = '$idmatkul'";
    $hasil = query_getData($sqljoin);
    return $hasil;
}
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Englebert|Combo|Special+Elite|Modern+Antiqua&display=swap&subset=latin-ext&effect=shadow-multiple">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source%20Code%20Pro">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@1,700&display=swap">
    <style>
        a:link {
            text-decoration: none;
            text-decoration-color: unset;
        }
        h1{
            font:normal normal 100% Josefin Sans;
            color:#776f9f;
        }
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
    <title>Jadwal Kuliah</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#option" aria-controls="option" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="option">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="listMatkul.php">Daftar Mata Kuliah<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Tambah
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="tanbahJadwalMatkul.php">Jadwal Matkul</a>
                        <a class="dropdown-item" href="tambahJadwalUTS.php">Jadwal UTS</a>
                        <a class="dropdown-item" href="tambahJadwalUAS.php">Jadwal UAS</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <table border="0" align="center" cellpadding="10" cellspacing="0" style="width: 90%;">
        <thead align="center">
            <tr>
                <th>
                    <h1 class="display-4 font-weight-bolder font-effect-shadow-multiple">JADWAL PERKULIAHAN</h1>
                </th>
            </tr>
        </thead>

        <tbody align="center">
            <td>
                <div class="card bg-dark mb-3">
                    <h3 class="card-header text-primary font-weight-bolder">Jadwal Mata Kuliah Online</h3>
                    <div class="card-body">
                        <h5 class="card-title">Daftar tugas yang belum dikerjakan</h5>
                        <div class="card-columns text-dark">
                            <?php if (!$showMatkul) : ?>
                                <div class="card">
                                    <div class="card-body">Data Masih Kosong...
                                    </div>
                                </div>
                            <?php else : ?>
                                <?php for ($hari = 1; $hari < 6; $hari++) {
                                    switch ($hari) {
                                        case 1:
                                            echo "<div class='card border-secondary mb-3' style='max-width: 34rem;'>";
                                            echo "<h4 class='card-header font-weight-bolder'>SENIN</h4>";
                                            echo "<div class='card-body text-secondary'>";
                                            foreach ($showMatkul as $row) {
                                                $hasil = joinTugas($row["idmatkul"]);
                                                if ($row["hari"] == $hari) {
                                                    echo "<div class='card text-left border-secondary mb-3' style='max-width: 28rem;'>";
                                                    echo "<h5 class='card-header'> <a class='text-secondary' href='" . $row["linkmedia"] . "' 
                                                         target='_blank'>" . $row["matkul"] . "</a>";
                                                    echo " <small>" . $row["jenis"] . "</small> </h5>";
                                                    echo "<div class='card-body text-secondary'>";
                                                    echo "<h6 class='card-title text-right'>" . $row["waktu"] . "</h6>";
                                                    echo "<ul class='list-group list-group-flush'>";
                                                    foreach ($hasil as $col) {
                                                        echo "<li class='list-group-item'>" . $col["namaTugas"] . "</br>";
                                                        echo "<div class='btn-group btn-group-sm' role='group'>";
                                                        echo "<a href='" . $col["link"] . "' class='card-link btn btn-outline-warning btn-sm'
                                                            role='button' aria-pressed='active' target='_blank'>Buka</a>";
                                                        echo "<a href='hapus.php?id=" . $col["idtugas"] . "&name=tugas' 
                                                            class='btn btn-outline-danger btn-sm' role='button'
                                                            aria-pressed='active'>Selesai</a></div></li>";
                                                    }
                                                    echo "<footer class='blockquote-footer'>Ingin menambah Tugas?
                                                        <cite title='Tugas Baru'><a href='tambahTugas.php?idmatkul=" . $row["idmatkul"] . "' class='text-primary'
                                                        role='button' aria-pressed='active'>Tambah</a></cite></footer>";
                                                    echo "</ul></div></div>";
                                                }
                                            }
                                            echo "</div></div>";
                                            break;
                                        case 2:
                                            echo "<div class='card border-success mb-3' style='max-width: 34rem;'>";
                                            echo "<h4 class='card-header font-weight-bolder'>SELASA</h4>";
                                            echo "<div class='card-body text-success'>";
                                            foreach ($showMatkul as $row) {
                                                $hasil = joinTugas($row["idmatkul"]);
                                                if ($row["hari"] == $hari) {
                                                    echo "<div class='card text-left border-success mb-3' style='max-width: 28rem;'>";
                                                    echo "<h5 class='card-header'> <a class='text-success' href='" . $row["linkmedia"] . "' title='Buka Media'
                                                         target='_blank'>" . $row["matkul"] . "</a>";
                                                    echo " <small>" . $row["jenis"] . "</small> </h5>";
                                                    echo "<div class='card-body text-success'>";
                                                    echo "<h6 class='card-title text-right'>" . $row["waktu"] . "</h6>";
                                                    echo "<ul class='list-group list-group-flush'>";
                                                    foreach ($hasil as $col) {
                                                        echo "<li class='list-group-item'>" . $col["namaTugas"] . "</br>";
                                                        echo "<div class='btn-group btn-group-sm' role='group'>";
                                                        echo "<a href='" . $col["link"] . "' class='card-link btn btn-outline-warning btn-sm'
                                                                role='button' aria-pressed='active' target='_blank'>Buka</a>";
                                                        echo "<a href='hapus.php?id=" . $col["idtugas"] . "&name=tugas' 
                                                                class='btn btn-outline-danger btn-sm' role='button'
                                                                aria-pressed='active'>Selesai</a></div></li>";
                                                    }
                                                    echo "<footer class='blockquote-footer'>Ingin menambah Tugas?
                                                            <cite title='Tugas Baru'><a href='tambahTugas.php?idmatkul=" . $row["idmatkul"] . "' class='text-primary'
                                                            role='button' aria-pressed='active'>Tambah</a></cite></footer>";
                                                    echo "</ul></div></div>";
                                                }
                                            }
                                            echo "</div></div>";
                                            break;
                                        case 3:
                                            echo "<div class='card border-warning mb-3' style='max-width: 34rem;'>";
                                            echo "<h4 class='card-header font-weight-bolder'>RABU</h4>";
                                            echo "<div class='card-body text-warning'>";
                                            foreach ($showMatkul as $row) {
                                                $hasil = joinTugas($row["idmatkul"]);
                                                if ($row["hari"] == $hari) {
                                                    echo "<div class='card text-left border-warning mb-3' style='max-width: 28rem;'>";
                                                    echo "<h5 class='card-header'> <a class='text-warning' href='" . $row["linkmedia"] . "' title='Buka Media'
                                                         target='_blank'>" . $row["matkul"] . "</a>";
                                                    echo " <small>" . $row["jenis"] . "</small> </h5>";
                                                    echo "<div class='card-body text-warning'>";
                                                    echo "<h6 class='card-title text-right'>" . $row["waktu"] . "</h6>";
                                                    echo "<ul class='list-group list-group-flush'>";
                                                    foreach ($hasil as $col) {
                                                        echo "<li class='list-group-item'>" . $col["namaTugas"] . "</br>";
                                                        echo "<div class='btn-group btn-group-sm' role='group'>";
                                                        echo "<a href='" . $col["link"] . "' class='card-link btn btn-outline-warning btn-sm'
                                                                    role='button' aria-pressed='active' target='_blank'>Buka</a>";
                                                        echo "<a href='hapus.php?id=" . $col["idtugas"] . "&name=tugas' 
                                                                    class='btn btn-outline-danger btn-sm' role='button'
                                                                    aria-pressed='active'>Selesai</a></div></li>";
                                                    }
                                                    echo "<footer class='blockquote-footer'>Ingin menambah Tugas?
                                                                <cite title='Tugas Baru'><a href='tambahTugas.php?idmatkul=" . $row["idmatkul"] . "' class='text-primary'
                                                                role='button' aria-pressed='active'>Tambah</a></cite></footer>";
                                                    echo "</ul></div></div>";
                                                }
                                            }
                                            echo "</div></div>";
                                            break;
                                        case 4:
                                            echo "<div class='card border-danger mb-3' style='max-width: 34rem;'>";
                                            echo "<h4 class='card-header font-weight-bolder'>KAMIS</h4>";
                                            echo "<div class='card-body text-danger'>";
                                            foreach ($showMatkul as $row) {
                                                $hasil = joinTugas($row["idmatkul"]);
                                                if ($row["hari"] == $hari) {
                                                    echo "<div class='card text-left border-danger mb-3' style='max-width: 28rem;'>";
                                                    echo "<h5 class='card-header'> <a class='text-danger' href='" . $row["linkmedia"] . "' title='Buka Media'
                                                         target='_blank'>" . $row["matkul"] . "</a>";
                                                    echo " <small>" . $row["jenis"] . "</small> </h5>";
                                                    echo "<div class='card-body text-danger'>";
                                                    echo "<h6 class='card-title text-right'>" . $row["waktu"] . "</h6>";
                                                    echo "<ul class='list-group list-group-flush'>";
                                                    foreach ($hasil as $col) {
                                                        echo "<li class='list-group-item'>" . $col["namaTugas"] . "</br>";
                                                        echo "<div class='btn-group btn-group-sm' role='group'>";
                                                        echo "<a href='" . $col["link"] . "' class='card-link btn btn-outline-warning btn-sm'
                                                                        role='button' aria-pressed='active' target='_blank'>Buka</a>";
                                                        echo "<a href='hapus.php?id=" . $col["idtugas"] . "&name=tugas' 
                                                                        class='btn btn-outline-danger btn-sm' role='button'
                                                                        aria-pressed='active'>Selesai</a></div></li>";
                                                    }
                                                    echo "<footer class='blockquote-footer'>Ingin menambah Tugas?
                                                                    <cite title='Tugas Baru'><a href='tambahTugas.php?idmatkul=" . $row["idmatkul"] . "' class='text-primary'
                                                                    role='button' aria-pressed='active'>Tambah</a></cite></footer>";
                                                    echo "</ul></div></div>";
                                                }
                                            }
                                            echo "</div></div>";
                                            break;
                                        case 5:
                                            echo "<div class='card border-primary mb-3' style='max-width: 34rem;'>";
                                            echo "<h4 class='card-header font-weight-bolder'>JUM'AT</h4>";
                                            echo "<div class='card-body text-primary'>";
                                            foreach ($showMatkul as $row) {
                                                $hasil = joinTugas($row["idmatkul"]);
                                                if ($row["hari"] == $hari) {
                                                    echo "<div class='card text-left border-primary mb-3' style='max-width: 28rem;'>";
                                                    echo "<h5 class='card-header'> <a class='text-primary' href='" . $row["linkmedia"] . "' title='Buka Media'
                                                         target='_blank'>" . $row["matkul"] . "</a>";
                                                    echo " <small>" . $row["jenis"] . "</small> </h5>";
                                                    echo "<div class='card-body text-primary'>";
                                                    echo "<h6 class='card-title text-right'>" . $row["waktu"] . "</h6>";
                                                    echo "<ul class='list-group list-group-flush'>";
                                                    foreach ($hasil as $col) {
                                                        echo "<li class='list-group-item'>" . $col["namaTugas"] . "</br>";
                                                        echo "<div class='btn-group btn-group-sm' role='group'>";
                                                        echo "<a href='" . $col["link"] . "' class='card-link btn btn-outline-warning btn-sm'
                                                                            role='button' aria-pressed='active' target='_blank'>Buka</a>";
                                                        echo "<a href='hapus.php?id=" . $col["idtugas"] . "&name=tugas' 
                                                                            class='btn btn-outline-danger btn-sm' role='button'
                                                                            aria-pressed='active'>Selesai</a></div></li>";
                                                    }
                                                    echo "<footer class='blockquote-footer'>Ingin menambah Tugas?
                                                                        <cite title='Tugas Baru'><a href='tambahTugas.php?idmatkul=" . $row["idmatkul"] . "' class='text-primary'
                                                                        role='button' aria-pressed='active'>Tambah</a></cite></footer>";
                                                    echo "</ul></div></div>";
                                                }
                                            }
                                            echo "</div></div>";
                                            break;
                                    }
                                } ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </td>
            <tr>
                <td>
                    <h3 class="text-warning font-weight-bolder">Jadwal UTS</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <table class="table table table-striped table-dark" style="width: 80%">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NAMA MATKUL</th>
                                <th>JENIS</th>
                                <th>TANGGAL</th>
                                <th>JAM</th>
                                <th>LANGKAH</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $i = 1; ?>
                            <?php if (!$showUTS)
                                echo "<tr>
                                <td colspan='9' style='text-align: center;'>Data Masih Kosong...</td></tr>"; ?>
                            <?php foreach ($showUTS as $row) : ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $row["matkul"] ?></td>
                                    <td><?= $row["jenis"] ?></td>
                                    <td><?= format_hari($row["tanggal"]); ?></td>
                                    <td><?= $row["waktu"] ?></td>
                                    <td><a href="ubahJadwal.php?id=<?= $row["iduts"]; ?>&name=uts" class="btn btn-outline-warning" role="button" aria-pressed="active">ubah</a>
                                        <a href="hapus.php?id=<?= $row["iduts"]; ?>&name=uts" class="btn btn-outline-danger" role="button" aria-pressed="active">hapus</a></td>
                                </tr>
                            <?php $i++;
                            endforeach; ?>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <h3 class="text-danger font-weight-bolder">Jadwal UAS</h3>
                </td>
            </tr>
            <tr>
                <td>
                    <table class="table table table-striped table-dark" style="width: 80%">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NAMA MATKUL</th>
                                <th>JENIS</th>
                                <th>TANGGAL</th>
                                <th>JAM</th>
                                <th>LANGKAH</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $i = 1; ?>
                            <?php if (!$showUAS)
                                echo "<tr>
                                <td colspan='9' style='text-align: center;'>Data Masih Kosong...</td></tr>"; ?>
                            <?php foreach ($showUAS as $row) : ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?= $row["matkul"] ?></td>
                                    <td><?= $row["jenis"] ?></td>
                                    <td><?= format_hari($row["tanggal"]); ?></td>
                                    <td><?= $row["waktu"] ?></td>
                                    <td><a href="ubahJadwal.php?id=<?= $row["iduas"]; ?>&name=uas" class="btn btn-outline-warning" role="button" aria-pressed="active">ubah</a>
                                        <a href="hapus.php?id=<?= $row["iduas"]; ?>&name=uas" class="btn btn-outline-danger" role="button" aria-pressed="active">hapus</a></td>

                                </tr>
                            <?php $i++;
                            endforeach; ?>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>

        <tfoot align="center">
            <tr>
                <td style="font-family: 'Courier New', Courier, monospace; font-size: 10pt"><b>© <?php echo date("M Y") ?></b>
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