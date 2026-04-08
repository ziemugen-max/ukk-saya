<?php
$koneksi = mysqli_connect("localhost", "root", "", "pengaduan_aspirasi");

if(!$koneksi){
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>