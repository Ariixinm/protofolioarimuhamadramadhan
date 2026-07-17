<?php
session_start();
include "config/koneksi.php";

// Tambah produk ke keranjang
if(isset($_GET['id'])){

    $id = (int)$_GET['id'];

    $query = mysqli_query($conn,"SELECT * FROM produk WHERE id_produk='$id'");

    if(mysqli_num_rows($query)>0){

        $produk = mysqli_fetch_assoc($query);

        if(isset($_SESSION['keranjang'][$id])){

            $_SESSION['keranjang'][$id]['jumlah']++;

        }else{

          $_SESSION['keranjang'][$id]=[
    "id_produk"=>$produk['id_produk'],
    "nama"=>$produk['nama_produk'],
    "harga"=>$produk['harga'],
    "gambar"=>$produk['gambar'],
    "jumlah"=>1
];

        }

    }

    header("Location: keranjang.php");
    exit;

}

// Hapus Produk
if(isset($_GET['hapus'])){

    unset($_SESSION['keranjang'][$_GET['hapus']]);

    header("Location: keranjang.php");
    exit;

}

?>
<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Keranjang Belanja</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<link rel="stylesheet" href="assets/css/keranjang.css">

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-success">

<div class="container">

<a class="navbar-brand" href="index.php">

UMKM Store

</a>

<ul class="navbar-nav ms-auto">

<li class="nav-item">

<a href="produk.php" class="nav-link">

Produk

</a>

</li>

<li class="nav-item">

<a href="index.php" class="nav-link">

Home

</a>

</li>

</ul>

</div>

</nav>

<div class="container mt-5">

<h2 class="mb-4">

<i class="fas fa-shopping-cart"></i>

Keranjang Belanja

</h2>

<?php

if(empty($_SESSION['keranjang'])){

?>

<div class="alert alert-warning">

Keranjang masih kosong.

</div>

<a href="produk.php" class="btn btn-success">

Belanja Sekarang

</a>

<?php

}else{

$total=0;

?>

<table class="table table-bordered table-hover align-middle">

<thead class="table-success">

<tr>

<th>Foto</th>

<th>Produk</th>

<th>Harga</th>

<th>jumlah</th>

<th>Subtotal</th>

<th>Aksi</th>

</tr>

</thead>

<tbody>

<tbody>

<?php

$total = 0;

foreach ($_SESSION['keranjang'] as $index => $item) {

    $id_produk = $item['id_produk'];
    $nama      = $item['nama'];
    $harga     = (int)$item['harga'];
    $jumlah    = (int)$item['jumlah'];
    $subtotal  = $harga * $jumlah;
    $total    += $subtotal;

    // Lokasi gambar
    $gambar = "assets/uploads/" . trim($item['gambar']);

    // Jika gambar tidak ada gunakan default
    if (empty($item['gambar']) || !file_exists(__DIR__ . "/" . $gambar)) {
        $gambar = "assets/uploads/no-image.jpg";
    }

?>

<tr>

    <td width="120" class="text-center">

        <img src="<?= $gambar; ?>"
             alt="<?= htmlspecialchars($nama); ?>"
             class="img-thumbnail"
             style="width:100px;height:100px;object-fit:cover;">

    </td>

    <td>
        <?= htmlspecialchars($nama); ?>
    </td>

    <td>
        Rp <?= number_format($harga,0,',','.'); ?>
    </td>

    <td class="text-center">
        <?= $jumlah; ?>
    </td>

    <td>
        Rp <?= number_format($subtotal,0,',','.'); ?>
    </td>

    <td>

        <a href="keranjang.php?hapus=<?= $id_produk; ?>"
           class="btn btn-danger btn-sm"
           onclick="return confirm('Hapus produk ini?')">

            <i class="fas fa-trash"></i>

        </a>

    </td>

</tr>

<?php } ?>

</tbody>

<tfoot>

<tr>

    <th colspan="4" class="text-end">
        Total
    </th>

    <th>
        Rp <?= number_format($total,0,',','.'); ?>
    </th>

    <th></th>

</tr>

</tfoot>

</table>

<div class="d-flex justify-content-between">

<a href="produk.php" class="btn btn-secondary">

<i class="fas fa-arrow-left"></i>

Lanjut Belanja

</a>

<a href="checkout.php" class="btn btn-success">

Checkout

<i class="fas fa-arrow-right"></i>

</a>

</div>
<?php
 } 
 ?>


</div>

</body>

</html>