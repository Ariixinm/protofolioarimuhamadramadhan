<?php

include_once __DIR__ . "/../config/koneksi.php";


// cek id pesanan

if(!isset($_GET['id'])){

    header("Location: pesanan.php");
    exit;

}


$id_pesanan = $_GET['id'];


// ambil data pesanan

$pesanan = mysqli_query($conn,"
SELECT *
FROM pesanan
WHERE id_pesanan='$id_pesanan'
");


$data = mysqli_fetch_assoc($pesanan);



if(!$data){

    die("Pesanan tidak ditemukan");

}



// ambil detail pesanan

$detail = mysqli_query($conn,"
SELECT 
detail_pesanan.*,
produk.nama_produk,
produk.harga,
produk.gambar

FROM detail_pesanan

JOIN produk 
ON detail_pesanan.id_produk = produk.id_produk

WHERE id_pesanan='$id_pesanan'
");

?>


<!DOCTYPE html>
<html>

<head>

<title>Detail Pesanan</title>

<link rel="stylesheet" href="assets/css/detail_pesanan.css">

</head>


<body>


<div class="container">


<div class="header">

<h2>
Detail Pesanan
</h2>


<a href="pesanan.php" class="btn">
Kembali
</a>


</div>



<div class="info">


<p>
<b>ID Pesanan :</b>
<?= $data['id_pesanan']; ?>
</p>


<p>
<b>Tanggal :</b>
<?= $data['tanggal']; ?>
</p>


<p>
<b>Status :</b>
<?= $data['status']; ?>
</p>


</div>




<table>


<tr>

<th>No</th>

<th>Gambar</th>

<th>Produk</th>

<th>Harga</th>

<th>Jumlah</th>

<th>Subtotal</th>

</tr>



<?php


$no=1;

$total=0;


while($row=mysqli_fetch_assoc($detail)){


$total += $row['subtotal'];


?>


<tr>


<td>
<?= $no++; ?>
</td>


<td>

<img 
src="../assets/uploads/<?= $row['gambar']; ?>"
class="gambar"
onerror="this.src='../assets/uploads/no-image.jpg'">

</td>


<td>
<?= $row['nama_produk']; ?>
</td>


<td>

Rp <?= number_format($row['harga']); ?>

</td>


<td>

<?= $row['jumlah']; ?>

</td>


<td>

Rp <?= number_format($row['subtotal']); ?>

</td>



</tr>


<?php } ?>



<tr>

<td colspan="5">

<b>Total</b>

</td>


<td>

<b>
Rp <?= number_format($total); ?>
</b>

</td>


</tr>



</table>


</div>


</body>

</html>