<?php

include_once __DIR__ . "/../config/koneksi.php";


// cek id

if(!isset($_GET['id'])){

    header("Location: produk.php");
    exit;

}


$id = $_GET['id'];


// ambil data produk

$query = mysqli_query($conn,"
SELECT * FROM produk 
WHERE id_produk='$id'
");


$data = mysqli_fetch_assoc($query);



if(!$data){

    die("Data produk tidak ditemukan");

}



// UPDATE DATA

if(isset($_POST['update'])){


    $nama_produk = mysqli_real_escape_string(
        $conn,
        $_POST['nama_produk']
    );


    $harga = $_POST['harga'];

    $stok = $_POST['stok'];



    // cek upload gambar

    if($_FILES['gambar']['name'] != ""){


        $gambar = $_FILES['gambar']['name'];

        $tmp = $_FILES['gambar']['tmp_name'];



        // upload gambar baru

        move_uploaded_file(
            $tmp,
            "../assets/uploads/".$gambar
        );



        $sql = mysqli_query($conn,"
        UPDATE produk SET

        nama_produk='$nama_produk',

        harga='$harga',

        stok='$stok',

        gambar='$gambar'


        WHERE id_produk='$id'

        ");


    }else{


        // tanpa gambar baru

        $sql = mysqli_query($conn,"
        UPDATE produk SET

        nama_produk='$nama_produk',

        harga='$harga',

        stok='$stok'


        WHERE id_produk='$id'

        ");

    }



    if($sql){


        echo "
        <script>
        alert('Produk berhasil diubah');
        window.location='produk.php';
        </script>
        ";


    }else{


        echo mysqli_error($conn);


    }


}


?>


<!DOCTYPE html>
<html>

<head>

<title>Edit Produk</title>

<link rel="stylesheet" href="assets/css/edit_produk.css">
</head>


<body>


<div class="container">


<div class="header">

<h2>Edit Produk</h2>


<a href="produk.php" class="btn-tambah">
Kembali
</a>


</div>




<form method="POST" enctype="multipart/form-data">



<label>Nama Produk</label>

<br>

<input 
type="text"
name="nama_produk"
value="<?= $data['nama_produk']; ?>"
required
>


<br><br>



<label>Harga</label>

<br>

<input 
type="number"
name="harga"
value="<?= $data['harga']; ?>"
required
>


<br><br>



<label>Stok</label>

<br>

<input 
type="number"
name="stok"
value="<?= $data['stok']; ?>"
required
>


<br><br>



<label>Gambar Lama</label>

<br>


<img 
src="../assets/uploads/<?= $data['gambar']; ?>"
width="120"
>


<br><br>



<label>Ganti Gambar</label>

<br>


<input 
type="file"
name="gambar"
>


<br><br>



<button 
name="update"
class="btn-tambah">

Update Produk

</button>



</form>



</div>


</body>

</html>