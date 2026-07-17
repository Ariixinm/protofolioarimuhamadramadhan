<?php

include_once __DIR__ . "/../config/koneksi.php";


// FILTER TANGGAL

$awal = "";
$akhir = "";

$where = "";


if(isset($_GET['awal']) && isset($_GET['akhir'])){


    $awal = $_GET['awal'];

    $akhir = $_GET['akhir'];


    $where = "
    WHERE DATE(tanggal)
    BETWEEN '$awal' AND '$akhir'
    ";

}



// DATA PESANAN

$query = mysqli_query($conn,"
SELECT *
FROM pesanan
$where
ORDER BY id_pesanan DESC
");



// TOTAL

$total = mysqli_query($conn,"
SELECT 
COUNT(id_pesanan) AS jumlah,
SUM(total_harga) AS pendapatan

FROM pesanan

$where
");


$data_total = mysqli_fetch_assoc($total);


?>


<!DOCTYPE html>
<html>

<head>

<title>Cetak Laporan</title>
<link rel="stylesheet" href="assets/css/cetak_laporan.css">


</head>


<body>



<h2>
LAPORAN PENJUALAN UMKM
</h2>



<?php if($awal!=""){ ?>

<p>
Periode :
<?= $awal; ?>
s/d
<?= $akhir; ?>
</p>

<?php } ?>



<div class="info">


<div>

<b>
Jumlah Transaksi
</b>

<br>

<?= $data_total['jumlah'] ?? 0; ?>

</div>


<div>

<b>
Total Pendapatan
</b>

<br>

Rp <?= number_format($data_total['pendapatan'] ?? 0); ?>

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
<?= $row['status']; ?>
</td>


</tr>


<?php } ?>


</table>



<br>


<button onclick="window.print()">

Cetak

</button>



</body>

</html>