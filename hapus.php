<?php
require 'funtions.php';

$idMt = $_GET["id"];
$tabel = $_GET["name"];

if ($uu = delete($idMt, $tabel) > 0) {
    if ($tabel) {
        echo "<script>
        document.location.href= 'index.php';
        </script>";
    }else {
        echo "<script>
        document.location.href= 'listMatkul.php';
        </script>";
    }
}else {
    echo "<script>
        alert('Data gagal dihapus!');
        </script>";
        var_dump($uu); die;
}
        //document.location.href= 'dataMhs.php';
?>