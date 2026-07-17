<?php
session_start();
include "config/koneksi.php";

// Cek apakah ID produk ada
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET['id'];

// Ambil data produk
$query = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = '$id'");

if (!$query) {
    die("Query Error : " . mysqli_error($conn));
}

if (mysqli_num_rows($query) == 0) {
    die("Produk tidak ditemukan.");
}

$produk = mysqli_fetch_assoc($query);

// Buat session wishlist jika belum ada
if (!isset($_SESSION['wishlist'])) {
    $_SESSION['wishlist'] = [];
}

// Cek apakah produk sudah ada di wishlist
$sudahAda = false;

foreach ($_SESSION['wishlist'] as $item) {
    if ($item['id_produk'] == $id) {
        $sudahAda = true;
        break;
    }
}

// Tambahkan ke wishlist jika belum ada
if (!$sudahAda) {

    $_SESSION['wishlist'][] = [
        "id_produk" => $produk['id_produk'],
        "nama"      => $produk['nama_produk'],
        "harga"     => $produk['harga'],
        "gambar"    => $produk['gambar']
    ];

}

// Kembali ke halaman wishlist
header("Location: wishlist.php");
exit;
?>