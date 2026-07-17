<?php

include_once __DIR__ . "/../config/koneksi.php";


// HAPUS PESANAN

if(isset($_GET['hapus'])){

    $id = $_GET['hapus'];


    // hapus detail terlebih dahulu

    mysqli_query($conn,"
    DELETE FROM detail_pesanan
    WHERE id_pesanan='$id'
    ");


    // hapus pesanan

    mysqli_query($conn,"
    DELETE FROM pesanan
    WHERE id_pesanan='$id'
    ");


    echo "
    <script>
    alert('Pesanan berhasil dihapus');
    window.location='pesanan.php';
    </script>
    ";

}



// AMBIL DATA PESANAN

$query = mysqli_query($conn,"
SELECT * FROM pesanan
ORDER BY id_pesanan DESC
");


?>


<!DOCTYPE html>
<html>

<head>

<title>Data Pesanan</title>

<link rel="stylesheet" href="assets/css/pesanan.css">

</head>


<body>


<div class="container">



<div class="header">

<h2>
Data Pesanan
</h2>


<a href="dashboard.php" class="btn">

Dashboard

</a>


</div>




<table>


<tr>

<th>No</th>

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
href="pesanan.php?hapus=<?= $row['id_pesanan']; ?>"
onclick="return confirm('Hapus pesanan?')"
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