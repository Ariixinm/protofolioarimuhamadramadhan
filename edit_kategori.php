<?php

include_once __DIR__ . "/../config/koneksi.php";


// CEK ID

if(!isset($_GET['id'])){

    header("Location:kategori.php");
    exit;

}


$id = $_GET['id'];


// AMBIL DATA KATEGORI

$query = mysqli_query($conn,"
SELECT * FROM kategori
WHERE id_kategori='$id'
");


$data = mysqli_fetch_assoc($query);



if(!$data){

    die("Kategori tidak ditemukan");

}



// UPDATE DATA

if(isset($_POST['update'])){


    $nama_kategori = mysqli_real_escape_string(
        $conn,
        $_POST['nama_kategori']
    );



    $update = mysqli_query($conn,"
    UPDATE kategori SET

    nama_kategori='$nama_kategori'

    WHERE id_kategori='$id'
    ");



    if($update){


        echo "
        <script>

        alert('Kategori berhasil diubah');

        window.location='kategori.php';

        </script>
        ";


    }else{


        echo "
        <script>

        alert('Gagal mengubah kategori');

        </script>
        ";


    }


}


?>


<!DOCTYPE html>
<html>

<head>

<title>Edit Kategori</title>

<link rel="stylesheet" href="assets/css/edit_kategori.css">

</head>


<body>


<div class="container">



<div class="header">


<h2>
Edit Kategori
</h2>



<a href="kategori.php" class="btn-kembali">

Kembali

</a>



</div>




<form method="POST">


<label>
Nama Kategori
</label>


<input 
type="text"
name="nama_kategori"
value="<?= $data['nama_kategori']; ?>"
required
>



<button name="update">

Update Kategori

</button>



</form>



</div>


</body>

</html>