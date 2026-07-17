<?php

include_once __DIR__ . "/../config/koneksi.php";


// HAPUS TRANSAKSI

if(isset($_GET['hapus'])){

    $id = $_GET['hapus'];


    // hapus detail transaksi dulu

    mysqli_query($conn,"
    DELETE FROM detail_pesanan
    WHERE id_pesanan='$id'
    ");


    // hapus transaksi

    mysqli_query($conn,"
    DELETE FROM pesanan
    WHERE id_pesanan='$id'
    ");


    echo "
    <script>
    alert('Transaksi berhasil dihapus');
    window.location='transaksi.php';
    </script>
    ";

}



// AMBIL DATA TRANSAKSI

$query = mysqli_query($conn,"
SELECT *
FROM pesanan
ORDER BY id_pesanan DESC
");


?>


<!DOCTYPE html>
<html>

<head>

<title>Data Transaksi</title>

<link rel="stylesheet" href="assets/css/transaksi.css">

</head>


<body>


<div class="container">


<div class="header">

<h2>
Data Transaksi
</h2>


<a href="dashboard.php" class="btn">
Dashboard
</a>


</div>



<table>


<tr>

<th>No</th>

<th>ID Transaksi</th>

<th>Nama Pelanggan</th>

<th>Tanggal</th>

<th>Total Harga</th>

<th>Status</th>

<th>Aksi</th>

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


<td>


<a 
href="detail_pesanan.php?id=<?= $row['id_pesanan']; ?>"
class="detail">

Detail

</a>



<a 
href="transaksi.php?hapus=<?= $row['id_pesanan']; ?>"
onclick="return confirm('Hapus transaksi ini?')"
class="hapus">

Hapus

</a>



</td>


</tr>


<?php } ?>


</table>



</div>


</body>

</html>