<?php
session_start();
include 'koneksi.php';

$nis = $_SESSION['nis'];
$data = mysqli_query($koneksi, "SELECT * FROM inputaspirasi WHERE nis='$nis'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Riwayat</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="riwayat-container">
    <h2>Riwayat Aspirasi</h2>

    <table class="table-riwayat">
        <tr>
            <th>Lokasi</th>
            <th>Keterangan</th>
            <th>Status</th>
            <th>Foto</th>
        </tr>

        <?php while($d = mysqli_fetch_array($data)){ ?>
<tr>
    <td><?php echo $d['lokasi']; ?></td>
    <td><?php echo $d['ket']; ?></td>

    <td>
    <?php 
    if($d['status'] == "menunggu"){
        echo "<span style='color:orange'>Menunggu</span>";
    } elseif($d['status'] == "diproses"){
        echo "<span style='color:blue'>Diproses</span>";
    } else {
        echo "<span style='color:green'>Selesai</span>";
    }
    ?>
    </td>
    
   <td>
<?php
$path = "uploads/" . $d['foto'];

if(!empty($d['foto']) && file_exists($path)){
?>
    <img src="<?php echo $path; ?>" width="80">
<?php
}else{
    echo "Tidak ada foto";
}
?>
</td>

</tr>
<?php } ?>
    </table>

    <br>
    <a href="halaman_siswa.php" class="btn-biru">Kembali</a>
</div>

</body>
</html>