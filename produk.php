<?php
session_start();
require_once "../config/koneksi.php";

// Cek login admin
// if(!isset($_SESSION['admin'])){
//     header("Location: login.php");
//     exit;
// }

$query = mysqli_query($conn,"
SELECT p.*, k.nama_kategori
FROM produk p
LEFT JOIN kategori k
ON p.id_kategori = k.id_kategori
ORDER BY p.id_produk DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data Produk</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<style>
img{
    width:90px;
    height:90px;
    object-fit:cover;
    border-radius:10px;
}
</style>

</head>
<body>

<div class="container py-4">

<div class="d-flex justify-content-between mb-3">

<h2>Data Produk</h2>

<a href="tambah_produk.php" class="btn btn-success">
<i class="fa fa-plus"></i>
Tambah Produk
</a>

</div>

<table class="table table-bordered table-hover">

<thead class="table-success">

<tr>

<th>No</th>
<th>Foto</th>
<th>Nama Produk</th>
<th>Kategori</th>
<th>Harga</th>
<th>Stok</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php
$no=1;

while($row=mysqli_fetch_assoc($query)){

    $gambar="../assets/uploads/".$row['gambar'];

    if(empty($row['gambar']) || !file_exists(__DIR__."/../assets/uploads/".$row['gambar'])){
        $gambar="../assets/uploads/no-image.jpg";
    }
?>

<tr>

<td><?= $no++; ?></td>

<td>

<img src="<?= $gambar; ?>">

</td>

<td><?= htmlspecialchars($row['nama_produk']); ?></td>

<td><?= htmlspecialchars($row['nama_kategori']); ?></td>

<td>Rp <?= number_format($row['harga'],0,',','.'); ?></td>

<td><?= $row['stok']; ?></td>

<td>

<a href="edit_produk.php?id=<?= $row['id_produk']; ?>"
class="btn btn-warning btn-sm">

<i class="fa fa-edit"></i>

</a>

<a href="hapus_produk.php?id=<?= $row['id_produk']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Hapus produk?')">

<i class="fa fa-trash"></i>

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</body>
</html>