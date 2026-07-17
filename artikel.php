<?php
include "config/koneksi.php";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel - UMKM Store</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/artikel.css">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            UMKM Store
        </a>

        <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="index.php" class="nav-link">Home</a>
                </li>

                <li class="nav-item">
                    <a href="produk.php" class="nav-link">Produk</a>
                </li>

                <li class="nav-item">
                    <a href="artikel.php" class="nav-link active">Artikel</a>
                </li>

                <li class="nav-item">
                    <a href="kontak.php" class="nav-link">Kontak</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Judul -->
<section class="container mt-5">

    <h2 class="text-center mb-4">
        <i class="fas fa-newspaper"></i>
        Artikel UMKM
    </h2>

    <div class="row">

        <div class="col-md-4 mb-4">

            <div class="card shadow">

                <img src="assets/uploads/marinasi.jpeg" class="card-img-top">

                <div class="card-body">

                    <h5 class="card-title">
                        Manfaat Mengonsumsi Lele
                    </h5>

                    <p class="card-text">
                        Lele merupakan sumber protein yang tinggi,
                        kaya omega 3 dan baik untuk kesehatan tubuh.
                    </p>

                    <a href="https://www.halodoc.com/artikel/ini-kandungan-nutrisi-dan-manfaat-ikan-lele-untuk-kesehatan" class="btn btn-success">
                        Baca Selengkapnya
                    </a>
            
                </div>

            </div>

        </div>

        <div class="col-md-4 mb-4">

            <div class="card shadow">

                <img src="assets/uploads/marinasi.jpeg" class="card-img-top">

                <div class="card-body">

                    <h5 class="card-title">
                        Tips Memilih Lele Segar
                    </h5>

                    <p class="card-text">
                        Kenali ciri-ciri lele segar agar kualitas
                        makanan tetap terjaga.
                    </p>

                    <a href="https://www.idntimes.com/food/diet/cara-mengolah-ikan-lele-agar-tidak-amis-dan-berlendir-c1c2-01-ph157-kdmz06" class="btn btn-success">
                        Baca Selengkapnya
                    </a>

                </div>

            </div>

        </div>

        <div class="col-md-4 mb-4">

            <div class="card shadow">

                <img src="assets/uploads/marinasi.jpeg" class="card-img-top">

                <div class="card-body">

                    <h5 class="card-title">
                        Resep Lele Bakar
                    </h5>

                    <p class="card-text">
                        Cara membuat lele bakar yang lezat dan cocok
                        untuk menu keluarga.
                    </p>

                    <a href="https://cookpad.com/id/cari/lele%20bakar" class="btn btn-success">
                        Baca Selengkapnya
                    </a>

                </div>

            </div>

        </div>

    </div>

</section>

</body>
</html>