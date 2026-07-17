<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>FAQ - UMKM Store</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<link rel="stylesheet" href="assets/css/faq.css">

</head>

<body>

<!-- Navbar -->

<nav class="navbar navbar-expand-lg navbar-dark bg-success">

<div class="container">

<a class="navbar-brand fw-bold" href="index.php">
UMKM Store
</a>

<button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="menu">

<ul class="navbar-nav ms-auto">

<li class="nav-item">
<a class="nav-link" href="index.php">Home</a>
</li>

<li class="nav-item">
<a class="nav-link" href="produk.php">Produk</a>
</li>

<li class="nav-item">
<a class="nav-link active" href="faq.php">FAQ</a>
</li>

<li class="nav-item">
<a class="nav-link" href="kontak.php">Kontak</a>
</li>

</ul>

</div>

</div>

</nav>

<!-- Header -->

<section class="faq-header">

<div class="container">

<h1>
<i class="fas fa-question-circle"></i>
Frequently Asked Questions
</h1>

<p>
Temukan jawaban atas pertanyaan yang sering diajukan pelanggan.
</p>

</div>

</section>

<!-- FAQ -->

<div class="container my-5">

<div class="accordion" id="faqAccordion">

<div class="accordion-item">

<h2 class="accordion-header">

<button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#faq1">

Bagaimana cara melakukan pemesanan?

</button>

</h2>

<div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">

<div class="accordion-body">

Pilih produk yang diinginkan, klik <b>Tambah Keranjang</b>, kemudian lanjutkan ke halaman Checkout untuk menyelesaikan pesanan.

</div>

</div>

</div>

<div class="accordion-item">

<h2 class="accordion-header">

<button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq2">

Metode pembayaran apa saja yang tersedia?

</button>

</h2>

<div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">

<div class="accordion-body">

Kami menerima pembayaran melalui Transfer Bank, COD (Bayar di Tempat), dan E-Wallet.

</div>

</div>

</div>

<div class="accordion-item">

<h2 class="accordion-header">

<button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq3">

Apakah produk selalu tersedia?

</button>

</h2>

<div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">

<div class="accordion-body">

Ketersediaan produk mengikuti stok yang ada di website. Jika stok habis maka produk tidak dapat dipesan.

</div>

</div>

</div>

<div class="accordion-item">

<h2 class="accordion-header">

<button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq4">

Apakah bisa mengembalikan barang?

</button>

</h2>

<div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">

<div class="accordion-body">

Pengembalian barang dapat dilakukan apabila produk rusak atau tidak sesuai pesanan maksimal 2x24 jam setelah diterima.

</div>

</div>

</div>

<div class="accordion-item">

<h2 class="accordion-header">

<button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq5">

Bagaimana cara menghubungi UMKM Store?

</button>

</h2>

<div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">

<div class="accordion-body">

Silakan hubungi kami melalui halaman Kontak atau WhatsApp yang tersedia di website.

</div>

</div>

</div>

</div>

</div>

<!-- Footer -->

<footer class="bg-success text-white text-center py-4">

<div class="container">

<p class="mb-1">
© 2026 UMKM Store. All Rights Reserved.
</p>

<p>

<i class="fab fa-facebook me-2"></i>

<i class="fab fa-instagram me-2"></i>

<i class="fab fa-whatsapp"></i>

</p>

</div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>