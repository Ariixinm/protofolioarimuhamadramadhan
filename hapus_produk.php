<?php

include_once __DIR__ . "/../config/koneksi.php";


if(!isset($_GET['id'])){

    header("Location: produk.php");
    exit;

}


$id = $_GET['id'];


// ambil gambar

$data = mysqli_query($conn,"
SELECT gambar FROM produk 
WHERE id_produk='$id'
");


$produk = mysqli_fetch_assoc($data);



if(!$produk){

    echo "
    <script>
    alert('Data produk tidak ditemukan');
    window.location='produk.php';
    </script>
    ";

    exit;

}



// hapus data database

$hapus = mysqli_query($conn,"
DELETE FROM produk 
WHERE id_produk='$id'
");



if($hapus){


    // hapus file gambar

    if(!empty($produk['gambar'])){


        $file = "../assets/uploads/".$produk['gambar'];


        if(file_exists($file)){

            unlink($file);

        }

    }



    echo "
    <script>
    alert('Produk berhasil dihapus');
    window.location='produk.php';
    </script>
    ";


}else{


    echo "
    <script>
    alert('Gagal menghapus produk : ".mysqli_error($conn)."');
    window.location='produk.php';
    </script>
    ";


}


?>