<?php
include 'funtions.php';

$id = $_GET["id"];

$data = query_getData("SELECT * FROM matkul WHERE idmatkul = $id");

if (isset($_POST["submit"])) {
    if (updateMatkul($_POST) > 0) {
        echo "<script>
        alert('Data berhasil diubah! ☺');
        document.location.href='listMatkul.php';
        </script>";
    }else {
        echo "<script>
        alert('Data Gagal diubah!');
        </script>";
        var_dump($_POST);
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
    <title>Ubah Mata Kuliah</title>
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
    <h1 class="display-3 text-info" align="center">Ubah Mata Kuliah</h1>
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
                            style="width: 80%; padding: 20px; border: 0px solid #f1f1f1; background-color: rgba(23, 162, 184, 0.2);">
                            <input class="form-control" type="hidden" name="id" value="<?= $data[0]["idmatkul"] ?>">
                            <div class="form-group">
                                <input type="namespace" class="form-control" id="matkul" name="matkul"
                                    placeholder="Nama Matkul" value="<?= $data[0]["matkul"] ?>" required>
                            </div>
                            <div class="form-group btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-info">
                                    <input type="radio" value="TEORI" name="jenis" <?php if($data[0]["jenis"]=="TEORI"){echo "checked";}?> required> Teori
                                </label>
                                <label class="btn btn-info">
                                    <input type="radio" value="GABUNGAN" name="jenis" <?php if($data[0]["jenis"]=="GABUNGAN"){echo "checked";}?> required> Gabungan
                                </label>
                                <label class="btn btn-info">
                                    <input type="radio" value="PRAKTIKUM" name="jenis" <?php if($data[0]["jenis"]=="PRAKTIKUM"){echo "checked";}?> required> Praktikum
                                </label>
                            </div> 
                            <br />
                            <div class="form-group">Hari
                                <div class="form-row">
                                    <div class="col-3">
                                        <select id="hari" class="form-control" name="hari" required>
                                            <option <?php if($data[0]["hari"]==1){echo "selected";}?> value="1">Senin</option>
                                            <option <?php if($data[0]["hari"]==2){echo "selected";}?> value="2">Selasa</option>
                                            <option <?php if($data[0]["hari"]==3){echo "selected";}?> value="3">Rabu</option>
                                            <option <?php if($data[0]["hari"]==4){echo "selected";}?> value="4">Kamis</option>
                                            <option <?php if($data[0]["hari"]==5){echo "selected";}?> value="5">Jumat</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">Jam
                                <div class="form-row">
                                    <div class="col-3">
                                        <select id="jam" class="form-control" name="jam" required>
                                            <?php for ($i=1; $i < 25; $i++): ?>
                                            <option value="<?php echo str_pad($i,2,"0",STR_PAD_LEFT); ?>">
                                                <?php echo str_pad($i,2,"0",STR_PAD_LEFT); ?></option>
                                            <?php endfor ?>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <select name="menit" class="form-control" id="menit" required>
                                            <?php for ($i=0; $i < 60; $i++): ?>
                                            <?php if ($i % 5) continue?>
                                            <option value="<?php echo str_pad($i,2,"0",STR_PAD_LEFT); ?>">
                                                <?php echo str_pad($i,2,"0",STR_PAD_LEFT); ?></option>
                                            <?php endfor ?>
                                        </select>
                                    </div>
                                </div>
                                <?php if ($data[0]["waktu"]!="01:00") {
                                   echo "<small id='emailHelp' class='form-text text-danger'>Harap atur kembali jam.</small>";
                                }?>
                            </div>
                            <div class="form-group">
                                <input type="namespace" class="form-control" id="linkmedia" name="linkmedia"
                                    placeholder="Paste Link - Media" value="<?= $data[0]["linkmedia"] ?>" required>
                            </div>
                            <div align="right">
                                <button type="submit" class="btn btn-info" name="submit">Simpan</button>
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
                    <br>Made with <small class="text-danger">❤</small> for <b>YOU</b> by <a href="https://berikhtiar.com/hide.980" class='text-white' target='_blank'>HiDe09</a></td>
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