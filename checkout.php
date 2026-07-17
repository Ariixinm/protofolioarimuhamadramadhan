<?php
session_start();

if(empty($_SESSION['keranjang'])){
    header("Location: invoice.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Checkout</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<link rel="stylesheet" href="assets/css/checkout.css">

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-success">

<div class="container">

<a class="navbar-brand fw-bold" href="index.php">

UMKM Store

</a>

</div>

</nav>

<div class="container mt-5">

<div class="row">

<!-- Form Pembeli -->

<div class="col-lg-7">

<div class="card shadow">

<div class="card-header bg-success text-white">

<h4>

<i class="fas fa-user"></i>

Data Pembeli

</h4>

</div>

<div class="card-body">

<form action="proses_checkout.php" method="POST">

<div class="mb-3">

<label>Nama Lengkap</label>

<input type="text"
name="nama"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Email</label>

<input type="email"
name="email"
class="form-control"
required>

</div>

<div class="mb-3">

<label>No WhatsApp</label>

<input type="text"
name="no_hp"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Alamat Lengkap</label>

<textarea
name="alamat"
rows="4"
class="form-control"
required></textarea>

</div>

<div class="mb-3">

<label>Metode Pembayaran</label>

<select
name="pembayaran"
class="form-select"
required>

<option value="">-- Pilih Pembayaran --</option>

<option>Transfer Bank</option>

<option>COD</option>

<option>E-Wallet</option>

</select>

</div>

<button
type="submit"
class="btn btn-success w-100">

<i class="fas fa-check-circle"></i>

Pesan Sekarang

</button>

</form>

</div>

</div>

</div>

<!-- Ringkasan -->

<!-- Ringkasan -->

<div class="col-lg-5">

<div class="card shadow">

<div class="card-header bg-warning">
<h4>
<i class="fas fa-shopping-cart"></i>
Ringkasan Belanja
</h4>
</div>

<div class="card-body">

<?php

$total = 0;

$fallback = [
    'lele bakar'   => 'assets/uploads/bakar.jpg',
    'lele hidup'   => 'assets/uploads/hidup.jpeg',
    'lele konsumsi'=> 'assets/uploads/konsumsi.jpeg',
    'marinasi'=> 'assets/uploads/marinasi.jpeg',
    'default'      => 'assets/uploads/konsumsi.jpeg',
];

foreach ($_SESSION['keranjang'] as $item) {

    $subtotal = $item['harga'] * $item['jumlah'];
    $total += $subtotal;

    $nama = strtolower(trim($item['nama_produk'] ?? $item['nama'] ?? ''));

    $gambar = '';
    if (!empty($item['gambar'])) {
        $path = 'uploads/' . $item['gambar'];
        if (file_exists($path)) {
            $gambar = $path;
        }
    }

    if (empty($gambar)) {
        $gambar = $fallback['default'];
        foreach ($fallback as $keyword => $path) {
            if ($keyword === 'default') continue;
            if (strpos($nama, $keyword) !== false) {
                $gambar = $path;
                break;
            }
        }
    }
?>

<div class="d-flex align-items-center mb-3">

    <!-- GAMBAR PRODUK -->
    <img 
    src="<?= $gambar; ?>"
    width="90"
    height="90"
    class="rounded"
    style="object-fit:cover;">


    <div class="ms-3">

        <h6 class="mb-1">
            <?= $item['nama']; ?>
        </h6>


        <p class="mb-0">
            <?= $item['jumlah']; ?> x 
            Rp <?= number_format($item['harga'],0,',','.'); ?>
        </p>


        <small class="text-success">
            Subtotal :
            Rp <?= number_format($subtotal,0,',','.'); ?>
        </small>

    </div>

</div>

<hr>

<?php } ?>


<h4 class="text-success">

Total :
Rp <?= number_format($total,0,',','.'); ?>

</h4>




</div>

</div>

</div>

</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>