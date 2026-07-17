<?php

include_once __DIR__ . "/../config/koneksi.php";


// FILTER TANGGAL

$awal = "";
$akhir = "";


$where = "";


if(isset($_POST['filter'])){


    $awal = $_POST['tanggal_awal'];

    $akhir = $_POST['tanggal_akhir'];


    $where = "
    WHERE DATE(tanggal) 
    BETWEEN '$awal' AND '$akhir'
    ";

}



// DATA LAPORAN

$query = mysqli_query($conn,"
SELECT *
FROM pesanan
$where
ORDER BY id_pesanan DESC
");



// TOTAL

$total = mysqli_query($conn,"
SELECT 
SUM(total_harga) AS pendapatan,
COUNT(id_pesanan) AS jumlah

FROM pesanan

$where
");


$hasil = mysqli_fetch_assoc($total);


?>


<!DOCTYPE html>
<html>

<head>

<title>Laporan Penjualan</title>

<link rel="stylesheet" href="assets/css/laporan.css">

</head>


<body>


<div class="container">



<div class="header">


<h2>
Laporan Penjualan
</h2>


<a href="dashboard.php" class="btn">
Dashboard
</a>


</div>



<!-- FILTER -->

<form method="POST" class="filter">


<div>

<label>
Tanggal Awal
</label>

<input 
type="date"
name="tanggal_awal"
value="<?= $awal; ?>"
>

</div>



<div>

<label>
Tanggal Akhir
</label>

<input 
type="date"
name="tanggal_akhir"
value="<?= $akhir; ?>"
>

</div>



<button name="filter">

Tampilkan

</button>



<a href="cetak_laporan.php" class="cetak">

Cetak

</a>


</form>




<!-- CARD TOTAL -->


<div class="card">


<div>

<h3>
Jumlah Transaksi
</h3>

<h2>
<?= $hasil['jumlah'] ?? 0; ?>
</h2>

</div>



<div>

<h3>
Total Pendapatan
</h3>


<h2>

Rp <?= number_format($hasil['pendapatan'] ?? 0); ?>

</h2>


</div>


</div>





<table>


<tr>

<th>No</th>

<th>ID Pesanan</th>

<th>Nama Pelanggan</th>

<th>Tanggal</th>

<th>Total Harga</th>

<th>Status</th>

</tr>



<?php


$no=1;


while($row=mysqli_fetch_assoc($query)){


?>


<tr>


<td>
<?= $no++; ?>
</td>


<td>
#<?= $row['id_pesanan']; ?>
</td>


<td>
<?= $row['id_pelanggan']; ?>
</td>


<td>
<?= $row['tanggal']; ?>
</td>


<td>

Rp <?= number_format($row['total_harga']); ?>

</td>


<td>

<span class="status">

<?= $row['status']; ?>

</span>

</td>


</tr>


<?php } ?>


</table>



</div>


</body>

</html>