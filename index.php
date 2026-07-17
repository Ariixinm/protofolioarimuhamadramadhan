<?php
include "config/koneksi.php";   

// Produk terbaru
$produk = mysqli_query($conn,"SELECT * FROM produk ORDER BY id_produk DESC LIMIT 4");

// Kategori
$kategori = mysqli_query($conn,"SELECT * FROM kategori");
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Petani Lele</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">

<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

<link rel="stylesheet" href="assets/css/style.css">

</head>
<body>

<!-- Navbar -->

<nav class="navbar navbar-expand-lg">

<div class="container">

<a class="navbar-brand" href="#">
    Petani Lele
</a>

<button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="menu">

<form class="d-flex mx-auto search-box" method="GET" action="produk.php">

<input class="form-control" placeholder="Cari Produk..." name="cari" required>

<button class="btn btn-warning ms-2" type="submit">

<i class="fa fa-search"></i>

</button>

</form>

<ul class="navbar-nav">

<li class="nav-item">


</li>

<li class="nav-item">
    <a class="nav-link <?= ($halaman=='index.php')?'active':''; ?>" href="index.php">Home</a>
</li>

<li class="nav-item">
    <a class="nav-link <?= ($halaman=='produk.php')?'active':''; ?>" href="produk.php">Produk</a>
</li>

<li class="nav-item">
    <a class="nav-link <?= ($halaman=='artikel.php')?'active':''; ?>" href="artikel.php">Artikel</a>
</li>

<li class="nav-item">
    <a class="nav-link <?= ($halaman=='kontak.php')?'active':''; ?>" href="kontak.php">Kontak</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="faq.php">FAQ</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="wishlist.php">
         Wishlist
    </a>
</li>

<li class="nav-item">

<a class="nav-link" href="login.php">

<i class="fa fa-user"></i>

Login

</a>

</li>


</div>

</div>

</nav>

<!-- Hero -->

<section class="hero">

<div class="container">


<div class="row align-items-center">

<div class="col-lg-6">

<h1 data-aos="fade-right">
Belanja Produk UMKM Berkualitas
</h1>

<p data-aos="fade-right">
Dukung produk lokal Indonesia dengan kualitas terbaik.
</p>

<a href="produk.php" class="btn btn-warning btn-lg">
Belanja Sekarang
</a>

</div>

</div>

</div>

</section>

<!-- Kategori -->

<div class="container mt-5">

<h2 class="mb-4">

Kategori Produk

</h2>

<div class="row">

<?php while($k=mysqli_fetch_array($kategori)){ ?>

<div class="col-md-3 mb-4">

<a href="produk.php?kategori=<?= $k['id_kategori']; ?>" class="text-decoration-none text-dark">

<div class="category-card">

<i class="fa fa-box fa-3x text-success mb-3"></i>

<h5><?= htmlspecialchars($k['nama_kategori']); ?></h5>

</div>

</a>

</div>

<?php } ?>

</div>

</div>

<!-- Flash Sale -->

<div class="container">

<div class="flash mb-4">

🔥 FLASH SALE HARI INI

</div>

</div>

<!-- Produk -->

<div class="container">

<h2 class="mb-4">

Produk Terbaru

</h2>

<div class="row">
<?php while($p=mysqli_fetch_array($produk)){ ?>

<div class="col-lg-3 col-md-6 mb-4">

<div class="card product-card">

<?php
$gambar = "assets/uploads/" . trim($p['gambar']);

if (empty($p['gambar']) || !file_exists($gambar)) {
    $gambar = "assets/uploads/lelebakar.jpg";
}
?>

<img src="<?= $gambar; ?>"
     class="card-img-top"
     alt="<?= htmlspecialchars($p['nama_produk']); ?>">

<div class="card-body">

<h5><?= htmlspecialchars($p['nama_produk']); ?></h5>

    <h4 class="text-success">
        Rp <?= number_format($p['harga'],0,',','.'); ?>
    </h4>

    <p>⭐ <?= isset($p['rating']) ? $p['rating'] : '5.0'; ?></p>

    <!-- Tombol Detail -->
    <a href="detail.php?id=<?= $p['id_produk']; ?>"
       class="btn btn-success w-100 mb-2">
        <i class="fas fa-eye"></i> Detail
    </a>

    <!-- Tombol Keranjang -->
    <a href="tambah_keranjang.php?id=<?= $p['id_produk']; ?>"
       class="btn btn-warning w-100 mb-2">
        <i class="fas fa-shopping-cart"></i> Keranjang
    </a>

    <!-- Tombol Wishlist -->
    <a href="tambah_wishlist.php?id=<?= $p['id_produk']; ?>"
       class="btn btn-outline-danger w-100">
        <i class="fas fa-heart"></i> Wishlist
    </a>


</div>

</div>

</div>

<?php } ?>

</div>

</div>

<!-- Tentang -->

<div class="container mt-5">

<div class="row align-items-center">

<div class="col-md-6">

<img src="assets/img/about2.webp" class="img-fluid rounded">

</div>

<div class="col-md-6">

<h2>

Tentang IKAN LELE

</h2>

<p>

Lele, atau ikan keli, adalah suatu keluarga ikan yang hidup di air tawar. Lele mudah dikenali karena tubuhnya yang licin, agak pipih memanjang, serta memiliki dua kumis panjang yang mencuat dari sekitar bagian mulutnya. Ikan ini banyak dikonsumsi karena rasanya yang enak jika dimasak dan biasanya digoreng atau dibakar.

</p>

</div>

</div>

</div>

<!-- Testimoni -->

<div class="container mt-5">

<h2 class="text-center mb-4">

Testimoni

</h2>

<div class="row">

<div class="col-md-4">

<div class="card">

<div class="card-body">

⭐⭐⭐⭐⭐

<p>

Produknya sangat bagus.

</p>

<b>- Andi</b>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card">

<div class="card-body">

⭐⭐⭐⭐⭐

<p>

Pelayanan cepat.

</p>

<b>- Budi</b>

</div>

</div>

</div>

<div class="col-md-4">

<div class="card">

<div class="card-body">

⭐⭐⭐⭐⭐

<p>

Harga murah.

</p>

<b>- Siti</b>

</div>

</div>

</div>

</div>

</div>

<!-- Newsletter -->

<div class="container mt-5">

<div class="bg-success text-white rounded p-5 text-center">

<h2>

Dapatkan Promo Terbaru

</h2>

<input class="form-control my-3" placeholder="Masukkan Email">

<button class="btn btn-warning">

Subscribe

</button>

</div>

</div>

<!-- Footer -->

<footer class="mt-5">

<div class="container">

<div class="row">

<div class="col-md-4">

<h4>
 PETANI LELE INDONESIA

</h4>

<p>

Produk Lokal Indonesia.

</p>

</div>

<div class="col-md-4">

<h4>

Kontak

</h4>

<p>

Email : arimuhmadramdhan@gmail.com

</p>

<p>

WA : 082124919262

</p>

</div>

<div class="col-md-4">

<h4>

Media Sosial

</h4>

<i class="fab fa-facebook fa-2x me-3"></i>

<i class="fab fa-instagram fa-2x me-3"></i>

<i class="fab fa-youtube fa-2x"></i>

</div>

</div>

</div>

</footer>

<!-- WhatsApp -->

<a href="https://wa.me/628123456789" class="whatsapp">

<i class="fab fa-whatsapp"></i>

</a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<script>

AOS.init();

</script>

</body>
</html>