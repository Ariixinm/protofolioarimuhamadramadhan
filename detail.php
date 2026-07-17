<?php
session_start();
require_once "config/koneksi.php";

if (!isset($_GET['id'])) {
    header("Location: produk.php");
    exit;
}

$id = (int)$_GET['id'];

$query = mysqli_query($conn, "
SELECT p.*, k.nama_kategori
FROM produk p
JOIN kategori k ON p.id_kategori = k.id_kategori
WHERE p.id_produk='$id'
");

if(mysqli_num_rows($query)==0){
    echo "<script>
    alert('Produk tidak ditemukan');
    window.location='produk.php';
    </script>";
    exit;
}

$data = mysqli_fetch_assoc($query);

$gambar = '';

if (!empty($data['gambar'])) {
    $gambar = 'uploads/' . $data['gambar'];

    if (!file_exists($gambar)) {
        $gambar = 'assets/uploads/' . $data['gambar'];
    }
}

if (empty($gambar) || !file_exists($gambar)) {
    $gambar = 'assets/uploads/hidup.jpeg';
}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?= htmlspecialchars($data['nama_produk']); ?></title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="assets/css/detail.css">

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-success">

<div class="container">

<a class="navbar-brand fw-bold" href="index.php">
UMKM Store
</a>

</div>

</nav>

<div class="container py-5">

<div class="row">

<!-- GAMBAR -->

<div class="col-lg-6">

<img src="<?= $gambar; ?>"
class="img-fluid detail-image">

</div>

<!-- DETAIL -->

<div class="col-lg-6">

<span class="badge bg-success">

<?= htmlspecialchars($data['nama_kategori']); ?>

</span>

<h2 class="mt-3">

<?= htmlspecialchars($data['nama_produk']); ?>

</h2>

<h3 class="text-success">

Rp <?= number_format($data['harga'],0,',','.'); ?>

</h3>

<p>

⭐⭐⭐⭐⭐ (<?= $data['rating']; ?>)

</p>

<p>

<b>Stok :</b>

<?= $data['stok']; ?>

</p>

<hr>

<h5>Deskripsi</h5>

<p>

<?= nl2br(htmlspecialchars($data['deskripsi'])); ?>

</p>

<a
href="keranjang.php?id=<?= $data['id_produk']; ?>"
class="btn btn-success">

Tambah ke Keranjang

</a>

<a
href="produk.php"
class="btn btn-secondary">

Kembali

</a>

</div>

</div>

</div>

</body>

</html>