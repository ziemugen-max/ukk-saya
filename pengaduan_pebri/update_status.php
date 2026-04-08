<?php
include 'koneksi.php';

$id = $_GET['id'];
$status = $_GET['status'];

mysqli_query($koneksi, "UPDATE inputaspirasi SET status='$status' WHERE id_pelaporan='$id'");

header("location:halaman_admin.php");
?>