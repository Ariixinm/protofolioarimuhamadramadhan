<?php
session_start();
include "../config/koneksi.php";

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

if ($_SESSION['level'] != 'admin') {
    header("Location: index.php");
    exit;
}

$admin = $_SESSION['nama'];

// Total Produk
$qProduk = mysqli_query($conn,"SELECT COUNT(*) AS total FROM produk");
$totalProduk = mysqli_fetch_assoc($qProduk)['total'];

// Total Kategori
$qKategori = mysqli_query($conn,"SELECT COUNT(*) AS total FROM kategori");
$totalKategori = mysqli_fetch_assoc($qKategori)['total'];

// Total Pesanan
$qPesanan = mysqli_query($conn,"SELECT COUNT(*) AS total FROM pesanan");
$totalPesanan = mysqli_fetch_assoc($qPesanan)['total'];

// Total Pelanggan
$qPelanggan = mysqli_query($conn,"SELECT COUNT(*) AS total FROM pelanggan");
$totalPelanggan = mysqli_fetch_assoc($qPelanggan)['total'];

// Total Pendapatan
$qPendapatan = mysqli_query($conn,"
SELECT IFNULL(SUM(total_harga),0) AS total
FROM pesanan
WHERE status='Selesai'
");

$totalPendapatan = mysqli_fetch_assoc($qPendapatan)['total'];

// Total Stok
$qStok = mysqli_query($conn,"
SELECT IFNULL(SUM(stok),0) AS total
FROM produk
");

$totalStok = mysqli_fetch_assoc($qStok)['total'];


?>


<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Dashboard Admin</title>

<link rel="stylesheet" href="assets/css/dashboard.css">


<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">


</head>

<body>

<!-- ================= Sidebar ================= -->

<div class="sidebar">

    <div class="logo">

        <i class="fa-solid fa-store"></i>

        <h2>UMKM Store</h2>

        <span>Admin Dashboard</span>

    </div>

    <ul>

        <li class="active">
            <a href="dashboard.php">
                <i class="fa-solid fa-house"></i>
                Dashboard
            </a>
        </li>

        <li>
            <a href="produk.php">
                <i class="fa-solid fa-box"></i>
                Produk
            </a>
        </li>

        <li>
            <a href="kategori.php">
                <i class="fa-solid fa-layer-group"></i>
                Kategori
            </a>
        </li>

        <li>
            <a href="pesanan.php">
                <i class="fa-solid fa-cart-shopping"></i>
                Pesanan
            </a>
        </li>

        <li>
            <a href="pelanggan.php">
                <i class="fa-solid fa-users"></i>
                Pelanggan
            </a>
        </li>

        <li>
            <a href="transaksi.php">
                <i class="fa-solid fa-money-bill"></i>
                Transaksi
            </a>
        </li>

        <li>
            <a href="laporan.php">
                <i class="fa-solid fa-chart-line"></i>
                Laporan
            </a>
        </li>

      

    </ul>

    <div class="logout">

        <a href="logout.php">

            <i class="fa-solid fa-right-from-bracket"></i>

            Logout

        </a>

    </div>

</div>

<!-- ================= Main ================= -->

<div class="main">

    <!-- Navbar -->

    <div class="navbar">

        <div class="menu-toggle">

            <i class="fa-solid fa-bars"></i>

        </div>

        <div class="navbar-right">

            <div class="notif">

                <i class="fa-regular fa-bell"></i>

                <span>3</span>

            </div>

            <div class="tanggal">

                <i class="fa-regular fa-calendar"></i>

                <?php echo date('d F Y'); ?>

            </div>

            <div class="profile">

                <img src="assets/img/admin.jpg" alt="admin">

                <div>

                    <h4><?php echo $admin; ?></h4>

                    <small>Administrator</small>

                </div>

            </div>

        </div>

    </div>

    <!-- Header -->

    <div class="header">

        <h1>Dashboard</h1>

        <p>Selamat Datang, <b><?php echo $admin; ?></b></p>

    </div>

<!-- ================= Isi Dashboard Dimulai di Bagian 2 ================= -->
<div class="cards">

    <div class="card">

        <div class="icon blue">
            <i class="fa-solid fa-box"></i>
        </div>

        <div class="info">

            <h2><?= $totalProduk ?></h2>

            <p>Total Produk</p>

        </div>

    </div>

    <div class="card">

        <div class="icon orange">
            <i class="fa-solid fa-layer-group"></i>
        </div>

        <div class="info">

            <h2><?= $totalKategori ?></h2>

            <p>Total Kategori</p>

        </div>

    </div>

    <div class="card">

        <div class="icon green">
            <i class="fa-solid fa-cart-shopping"></i>
        </div>

        <div class="info">

            <h2><?= $totalPesanan ?></h2>

            <p>Total Pesanan</p>

        </div>

    </div>

    <div class="card">

        <div class="icon purple">
            <i class="fa-solid fa-users"></i>
        </div>

        <div class="info">

            <h2><?= $totalPelanggan ?></h2>

            <p>Total Pelanggan</p>

        </div>

    </div>

    <div class="card">

        <div class="icon red">
            <i class="fa-solid fa-money-bill-wave"></i>
        </div>

        <div class="info">

            <h2>Rp <?= number_format($totalPendapatan,0,',','.') ?></h2>

            <p>Total Pendapatan</p>

        </div>

    </div>

    <div class="card">

        <div class="icon cyan">
            <i class="fa-solid fa-warehouse"></i>
        </div>

        <div class="info">

            <h2><?= $totalStok ?></h2>

            <p>Total Stok</p>

        </div>

    </div>

</div>
<div class="chart-container">

    <div class="chart-card">

        <h3>Grafik Penjualan</h3>

        <canvas id="salesChart"></canvas>

    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="assets/js/dashboard.js"></script>

</body>
</html>