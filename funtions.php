<?php
error_reporting(E_ALL ^ E_DEPRECATED);
$host = "localhost";
$user = "root";
$pass = "";
$dbName = "kelas";

$connect = mysqli_connect($host, $user, $pass) or die("gagal koneksi..."); //konek ke mysqlnya

$pilihDB = mysqli_select_db($connect, $dbName); //pilih database
if (!$pilihDB) {
    $pilihDB = mysqli_query($connect, "CREATE DATABASE $dbName"); //buat database
    if (!$pilihDB) {
        die("gagal buat database...");
    } else {
        $pilihDB = mysqli_select_db($connect, $dbName); //pilih database
        if (!$pilihDB) {
            die("gagal konek ke database...");
        }
    }
}

$sqlTabeluas = "CREATE TABLE IF NOT EXISTS uas (
    iduas int auto_increment not null primary key,
    matkul varchar(30) not null,
    jenis enum('TEORI','GABUNGAN','PRAKTIKUM') not null,
    tanggal date not null,
    waktu varchar(6) not null,
    KEY(matkul))";
query($sqlTabeluas) or die("gagal buat tabel uas."); //membuat tabel uas
$sqlTabeluts = "CREATE TABLE IF NOT EXISTS uts (
    iduts int auto_increment not null primary key,
    matkul varchar(30) not null,
    jenis enum('TEORI','GABUNGAN','PRAKTIKUM') not null,
    tanggal date not null,
    waktu varchar(6) not null,
    KEY(matkul))";
query($sqlTabeluts) or die("gagal buat tabel uts."); //membuat tabel uts

$sqlTabelmatkul = "CREATE TABLE IF NOT EXISTS matkul(
    idmatkul int auto_increment not null primary key,
    matkul varchar(80) not null,
    jenis enum('TEORI','GABUNGAN','PRAKTIKUM') not null,
    waktu varchar(6) not null,
    hari int not null,
    linkmedia varchar(200) not null,
    KEY(matkul))";
query($sqlTabelmatkul) or die("gagal buat tabel matkul."); //membuat tabel JadwalTugas


$sqlTabelTugas = "CREATE TABLE IF NOT EXISTS tugas(
    idtugas int auto_increment not null primary key,
    idmatkul int not null,
    namaTugas varchar(130) not null,
    link varchar(200) not null,
    KEY(namaTugas))";
query($sqlTabelTugas) or die("gagal buat tabel Tugas."); //membuat tabel Tugas


function query($query) {
    global $connect;
    $jadi = mysqli_query($connect, $query);
    return $jadi;
}

function query_getData($query){
    global $connect;
    $select = mysqli_query($connect, $query); //select * data
    $view = [];
    while ( $row = mysqli_fetch_assoc($select)) {
        $view[] = $row;
    }
    return $view; 
}

function tambah($data, $tabel){
    global $connect;
    $id = $data["id"];
    $hasil = query_getData("SELECT * FROM matkul WHERE idmatkul='$id'");
    $matkul = $hasil[0]['matkul'];
    $jenis = $hasil[0]['jenis'];
    $tanggal = $data["tanggal"];
    $jam = $data["jam"];
    $menit = $data["menit"];
    $waktu = $jam.":".$menit;
    mysqli_query($connect,"INSERT INTO $tabel VALUES
        ('', '$matkul', '$jenis', '$tanggal', '$waktu')");
    return mysqli_affected_rows($connect);
}

function tambahMatkul($data){
    global $connect;
    //masukan ke tabel JadwalTugas
    $matkul = htmlspecialchars($data["matkul"]);
    $jenis = $data["jenis"];
    $jam = $data["jam"];
    $menit = $data["menit"];
    $waktu = $jam.":".$menit;
    $hari = $data["hari"];
    $linkmedia = $data["linkmedia"];
    mysqli_query($connect,"INSERT INTO matkul VALUES
                ('','$matkul','$jenis','$waktu','$hari','$linkmedia')");
    
    return mysqli_affected_rows($connect);
}
function tambahTugas($data){
    global $connect;
    $idmatkul = $data["idmatkul"];
    $namaTugas = htmlspecialchars($data["namaTugas"]);
    $link = htmlspecialchars($data["link"]);
    //masukan ke tabel tugas
    mysqli_query($connect,"INSERT INTO tugas VALUES
                ('', '$idmatkul', '$namaTugas', '$link')");
    
    return mysqli_affected_rows($connect);
}
function update($data, $tabel){
    global $connect;

    $id = $data["id"];
    $matkul = htmlspecialchars($data["matkul"]);
    $jenis = $data["jenis"];
    $tanggal = $data['tanggal'];
    $jam = $data["jam"];
    $menit = $data["menit"];
    $waktu = $jam.":".$menit;

    mysqli_query($connect, "UPDATE $tabel SET matkul = '$matkul',
            jenis = '$jenis', tanggal = '$tanggal', waktu = '$waktu' 
            WHERE id$tabel = $id");
    
    return mysqli_affected_rows($connect);
}

function delete($data, $tabel){
    global $connect;
    query("DELETE FROM $tabel WHERE id$tabel = $data");
    return mysqli_affected_rows($connect);
}

function format_hari($waktu){
    $hari_array = array('Minggu','Senin','Selasa','Rabu',
        'Kamis','Jumat','Sabtu');
    $hr = date('w', strtotime($waktu));

    $bulan_array = array(1 => 'Januari', 2 => 'Februari',
        3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni',
        7 => 'Juli', 8 => 'Agustus', 9 => 'September',
        10 => 'Oktober', 11 => 'November', 12 => 'Desember');
    $bl = date('n', strtotime($waktu));
    
    $hari = $hari_array[$hr];
    $tanggal = date('j', strtotime($waktu));
    $bulan = $bulan_array[$bl];
    $tahun = date('Y', strtotime($waktu));
    $jam = date( 'H:i:s', strtotime($waktu));
    
    //untuk menampilkan hari, tanggal bulan tahun jam
    //return "$hari, $tanggal $bulan $tahun $jam";

    //untuk menampilkan hari, tanggal bulan tahun
    return "$hari, $tanggal $bulan $tahun";
}
function hari($hari){
    $hari_array = array('Minggu','Senin','Selasa','Rabu',
        'Kamis','Jumat','Sabtu');
    $hari = $hari_array[$hari];
    return "$hari";
}
?>