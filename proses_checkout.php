<?php

session_start();

include "config/koneksi.php";


if(empty($_SESSION['keranjang'])){

header("Location: invoice.php");

exit;

}


$nama = mysqli_real_escape_string($conn, trim($_POST['nama'] ?? ''));
$email = mysqli_real_escape_string($conn, trim($_POST['email'] ?? ''));
$no_hp = mysqli_real_escape_string($conn, trim($_POST['no_hp'] ?? ''));
$alamat = mysqli_real_escape_string($conn, trim($_POST['alamat'] ?? ''));
$tanggal = date("Y-m-d H:i:s");
$pembayaran = mysqli_real_escape_string($conn, trim($_POST['pembayaran'] ?? ''));

$no_hp = substr($no_hp, 0, 20);

if ($nama === '' || $email === '' || $no_hp === '' || $alamat === '' || $pembayaran === '') {
    die("Data pembeli belum lengkap.");
}

// SIMPAN PELANGGAN
$simpan_pelanggan = mysqli_query($conn, "INSERT INTO pelanggan (nama, email, no_hp, alamat) VALUES ('$nama', '$email', '$no_hp', '$alamat')");

if (!$simpan_pelanggan) {
    die("Gagal menyimpan data pelanggan : " . mysqli_error($conn));
}

$id_pelanggan = mysqli_insert_id($conn);

if (!$id_pelanggan) {
    die("Gagal mendapatkan ID pelanggan.");
}

// hitung total

$total = 0;

foreach($_SESSION['keranjang'] as $item){
    $qty = isset($item['qty']) ? (int)$item['qty'] : (isset($item['jumlah']) ? (int)$item['jumlah'] : 1);
    $qty = max(1, $qty);

    $harga = isset($item['harga']) ? (float)$item['harga'] : 0;
    $total += $harga * $qty;
}



// SIMPAN PESANAN

$simpan = mysqli_query($conn,"
INSERT INTO pesanan
(id_pelanggan,tanggal,total_harga,pembayaran)
VALUES
('$id_pelanggan','$tanggal','$total','$pembayaran')
");

if(!$simpan){
    die("Gagal menyimpan pesanan : " . mysqli_error($conn));
}

// Ambil ID pesanan yang baru dibuat
$id_pesanan = mysqli_insert_id($conn);


// =====================
// SIMPAN DETAIL PESANAN
// =====================

foreach($_SESSION['keranjang'] as $item){
    $qty = isset($item['qty']) ? (int)$item['qty'] : (isset($item['jumlah']) ? (int)$item['jumlah'] : 1);
    $qty = max(1, $qty);

    $subtotal = (isset($item['harga']) ? (float)$item['harga'] : 0) * $qty;

    $id_produk = isset($item['id_produk']) ? $item['id_produk'] : (isset($item['id']) ? $item['id'] : 0);

    $simpan_detail = mysqli_query($conn," 
    INSERT INTO detail_pesanan
    (
        id_pesanan,
        id_produk,
        jumlah,
        harga,
        subtotal
    )
    VALUES
    (
        '$id_pesanan',
        '$id_produk',
        '$qty',
        '{$item['harga']}',
        '$subtotal'
    )
    ");

    if(!$simpan_detail){
        die("Gagal menyimpan detail pesanan : " . mysqli_error($conn));
    }
}

// =====================
// KOSONGKAN KERANJANG
// =====================

unset($_SESSION['keranjang']);


// =====================
// PINDAH KE INVOICE
// =====================

header("Location: invoice.php?id=".$id_pesanan);
exit;


?>