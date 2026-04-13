<?php
session_start();
include 'koneksi.php';

if($_SESSION['level'] != "admin"){
    header("Location: index.php");
}

$data = mysqli_query($koneksi, "
SELECT inputaspirasi.*, siswa.kelas, kategori.ket_kategori
FROM inputaspirasi
JOIN siswa ON inputaspirasi.nis = siswa.nis
JOIN kategori ON inputaspirasi.id_kategori = kategori.id_kategori
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    <span>Dasboard Admin</span>
    <a href="logout.php" class="logout-btn">Logout</a>
</div>

<div class="riwayat-container">
    <h2>Data Aspirasi</h2>

    <table class="table-riwayat">
        <tr>
            <th>NIS</th>
            <th>Kelas</th>
            <th>Kategori</th>
            <th>Lokasi</th>
            <th>Keterangan</th>
            <th>Foto</th>
            <th>Status</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>

        <?php while($d = mysqli_fetch_array($data)){ ?>
<tr>
    <td><?php echo $d['nis']; ?></td>
    <td><?php echo $d['kelas']; ?></td>
    <td><?php echo $d['ket_kategori']; ?></td>
    <td><?php echo $d['lokasi']; ?></td>
    <td><?php echo $d['ket']; ?></td>
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

    <!-- STATUS -->
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

    <td><?php echo $d['tanggal']; ?></td>


    <!-- AKSI -->
    <td>
<form method="GET" action="update_status.php">
    <input type="hidden" name="id" value="<?php echo $d['id_pelaporan']; ?>">

    <select name="status" onchange="this.form.submit()" style="padding:5px;border-radius:5px;">
        <option value="menunggu" <?php if($d['status']=="menunggu") echo "selected"; ?>>Menunggu</option>
        <option value="diproses" <?php if($d['status']=="diproses") echo "selected"; ?>>Diproses</option>
        <option value="selesai" <?php if($d['status']=="selesai") echo "selected"; ?>>Selesai</option>
    </select>

</form>
</td>

</tr>
<?php } ?>
    </table>
</div>

</body>
</html>