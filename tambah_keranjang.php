<?php


session_start();
include "config/koneksi.php"; // sesuaikan lokasi file

// cek id produk
if(isset($_GET['id'])){

    $id = $_GET['id'];

    // ambil produk dari database
    $query = mysqli_query($conn, 
        "SELECT * FROM produk WHERE id_produk='$id'"
    );

    $produk = mysqli_fetch_assoc($query);


    if($produk){

        if(!isset($_SESSION['keranjang'])){
            $_SESSION['keranjang'] = [];
        }


        $ada = false;

        foreach($_SESSION['keranjang'] as &$item){

            if($item['id_produk'] == $id){

                $item['jumlah']++;
                $ada = true;
                break;

            }

        }


        if(!$ada){

            $_SESSION['keranjang'][] = [
                "id_produk" => $produk['id_produk'],
                "nama" => $produk['nama_produk'],
                "harga" => $produk['harga'],
                "gambar" => $produk['gambar'],
                "jumlah" => 1
            ];

        }


        // pindah halaman setelah tambah
        header("Location: keranjang.php");
        exit;


    }else{

        echo "Produk tidak ditemukan";

    }


}else{

    echo "ID Produk tidak ada";

}

?>