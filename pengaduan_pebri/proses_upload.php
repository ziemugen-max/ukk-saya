<?php
session_start();
include 'koneksi.php';

$id_kategori = $_POST['id_kategori'];
$lokasi = $_POST['lokasi'];
$ket = $_POST['ket'];

$nis = $_SESSION['nis'];

$nama_file = $_FILES['foto']['name'];
$tmp = $_FILES['foto']['tmp_name'];

if ($nama_file != '') {
    $nama_baru = time() . '_' . $nama_file;
    move_uploaded_file($tmp, "uploads/" . $nama_baru);
} else {
    $nama_baru = NULL;
}

$query = mysqli_query($koneksi, "INSERT INTO inputaspirasi 
(id_kategori,nis, lokasi, ket, status, foto)
VALUES
('$id_kategori', '$nis', '$lokasi', '$ket', 'menunggu', '$nama_baru')");

if($query){
    echo "<script>
        alert('Aspirasi berhasil dikirim!');
        window.location='halaman_siswa.php';
    </script>";
} else {
    echo "Gagal: " . mysqli_error($koneksi);
}
?>