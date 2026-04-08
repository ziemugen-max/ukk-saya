<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

// LOGIN ADMIN
$admin = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$username' AND password='$password'");

if(mysqli_num_rows($admin) > 0){
    $_SESSION['login'] = true;
    $_SESSION['level'] = "admin";
    header("Location: halaman_admin.php");
    exit;
}

// LOGIN SISWA (PAKAI NIS SAJA)
$siswa = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$username'");

if(mysqli_num_rows($siswa) > 0){
    $data = mysqli_fetch_assoc($siswa);

    $_SESSION['login'] = true;
    $_SESSION['level'] = "siswa";
    $_SESSION['nis'] = $data['nis'];
    $_SESSION['kelas'] = $data['kelas'];

    header("Location: halaman_siswa.php");
    exit;
}

echo "<script>alert('Login gagal');window.location='index.php';</script>";
?>