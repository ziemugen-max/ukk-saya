<?php
session_start();
include 'koneksi.php';

if($_SESSION['level'] != 'siswa'){
    header("Location: index.php");
}

$nis = $_SESSION['nis'];
$siswa = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$nis'"));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Halaman Siswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
 <span>
Siswa (NIS: <?php echo $_SESSION['nis']; ?> | Kelas: <?php echo $siswa['kelas']; ?>)
</span>
    <a href="logout.php" class="logout-btn">Logout</a>
</div>

<div class="container">
    <h2>Kirim Aspirasi</h2>

    <form action="proses_upload.php" method="POST" enctype="multipart/form-data">

        <select name="id_kategori" required>
    <option value=""> Pilih Kategori </option>

    <?php
    include 'koneksi.php';
    $kategori = mysqli_query($koneksi, "SELECT * FROM kategori");

    while($k = mysqli_fetch_array($kategori)){
    ?>
        <option value="<?php echo $k['id_kategori']; ?>">
            <?php echo $k['ket_kategori']; ?>
        </option>
    <?php } ?>

</select>

        <input type="hidden" name="nis" value="<?php echo $_SESSION['nis']; ?>">

        <input type="text" name="lokasi" placeholder="Lokasi" required>
        <textarea name="ket" placeholder="Isi Aspirasi" required></textarea>


        <input type="file" name="foto" >

        <button type="submit">Kirim</button>

    </form>

    <br>
    <a href="riwayat_aspirasi.php" class="btn-biru">Lihat Riwayat Anda</a>
</div>

</body>
</html>