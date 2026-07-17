<?php
include "config/koneksi.php";

if(!isset($_GET['id']) || empty($_GET['id'])){
    die("ID Pesanan tidak ditemukan.");
}


$id = (int)$_GET['id'];

// Ambil data pesanan + pelanggan
$query = mysqli_query($conn, "
SELECT
    pesanan.*,
    pelanggan.nama,
    pelanggan.email,
    pelanggan.no_hp,
    pelanggan.alamat
FROM pesanan
INNER JOIN pelanggan
ON pesanan.id_pelanggan = pelanggan.id_pelanggan
WHERE pesanan.id_pesanan = '$id'
");

if (!$query) {
    die("Query Error : " . mysqli_error($conn));
}

if (mysqli_num_rows($query) == 0) {
    die("Data invoice tidak ditemukan.");
}

$order = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Invoice</title>

<link rel="stylesheet" href="assets/css/invoice.css">

</head>

<body>

<div class="invoice">

    <h2>UMKM STORE</h2>

    <hr>

   <h3>Invoice Pembayaran</h3> 

    <div class="info">

        <p><strong>Nama :</strong> <?= $order['nama']; ?></p>

        <p><strong>Email :</strong> <?= $order['email']; ?></p>

        <p><strong>No HP :</strong> <?= $order['no_hp']; ?></p>

        <p><strong>Alamat :</strong> <?= $order['alamat']; ?></p>

        <p><strong>Tanggal :</strong> <?= $order['tanggal']; ?></p>

        <p><strong>Pembayaran :</strong> <?= $order['pembayaran']; ?></p>

    </div>

    <table>

        <thead>

            <tr>

                <th>ID Produk</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th>Subtotal</th>

            </tr>

        </thead>

        <tbody>

        <?php

        $total = 0;

        $detail = mysqli_query($conn, "
        SELECT *
        FROM detail_pesanan
        WHERE id_pesanan='$id'
        ");

        while($d = mysqli_fetch_assoc($detail)){

            $total += $d['subtotal'];
        ?>

            <tr>

                <td><?= $d['id_produk']; ?></td>

                <td><?= $d['jumlah']; ?></td>

                <td>Rp <?= number_format($d['harga'],0,',','.'); ?></td>

                <td>Rp <?= number_format($d['subtotal'],0,',','.'); ?></td>

            </tr>

        <?php } ?>

        </tbody>

    </table>

    <div class="total">

        Total : Rp <?= number_format($total,0,',','.'); ?>

    </div>

    <div class="aksi">

        <a href="index.php" class="btn">
            Kembali Belanja
        </a>

        <button onclick="window.print()" class="btn btn-print">
            Cetak Invoice
        </button>

    </div>

</div>

</body>
</html>