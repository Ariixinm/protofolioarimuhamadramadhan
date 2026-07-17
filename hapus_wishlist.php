<?php
session_start();

// Cek apakah ID produk dikirim
if (!isset($_GET['id'])) {
    header("Location: wishlist.php");
    exit;
}

$id = (int) $_GET['id'];

// Cek apakah wishlist ada
if (isset($_SESSION['wishlist'])) {

    foreach ($_SESSION['wishlist'] as $key => $item) {

        if ($item['id_produk'] == $id) {

            unset($_SESSION['wishlist'][$key]);

        }

    }

    // Rapikan kembali index array
    $_SESSION['wishlist'] = array_values($_SESSION['wishlist']);
}

// Kembali ke halaman wishlist
header("Location: wishlist.php");
exit;
?>