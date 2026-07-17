<?php

include_once __DIR__ . "/../config/koneksi.php";


// TAMBAH KATEGORI

if(isset($_POST['tambah'])){

    $nama = mysqli_real_escape_string(
        $conn,
        $_POST['nama_kategori']
    );


    mysqli_query($conn,"
    INSERT INTO kategori
    (nama_kategori)

    VALUES
    ('$nama')
    ");


    header("Location:kategori.php");
    exit;

}





// HAPUS KATEGORI

if(isset($_GET['hapus'])){

    $id = $_GET['hapus'];

    $hapus = mysqli_query($conn,"
        DELETE FROM kategori
        WHERE id_kategori='$id'
    ");


    if($hapus){

        echo "
        <script>
        alert('Kategori berhasil dihapus');
        window.location='kategori.php';
        </script>
        ";

    }else{

        echo "
        <script>
        alert('Gagal hapus: ".mysqli_error($conn)."');
        window.location='kategori.php';
        </script>
        ";

    }

}





// DATA KATEGORI

$data=mysqli_query($conn,"
SELECT * FROM kategori
ORDER BY id_kategori DESC
");


?>


<!DOCTYPE html>
<html>

<head>

<title>Kategori Produk</title>

<link rel="stylesheet" href="assets/css/kategori.css">

</head>


<body>


<div class="container">


<div class="header">

<h2>
Kategori Produk
</h2>


<a href="dashboard.php" class="btn">

Kembali

</a>


</div>




<!-- FORM TAMBAH -->


<form method="POST">


<input 
type="text"
name="nama_kategori"
placeholder="Nama kategori"
required
>


<button name="tambah">

Tambah

</button>


</form>



<br>


<!-- TABLE -->


<table>


<tr>

<th>No</th>

<th>Nama Kategori</th>

<th>Aksi</th>

</tr>



<?php

$no=1;

while($row=mysqli_fetch_assoc($data)){


?>


<tr>


<td>
<?= $no++; ?>
</td>


<td>
<?= $row['nama_kategori']; ?>
</td>


<td>


<a 
href="edit_kategori.php?id=<?= $row['id_kategori']; ?>"
class="edit">

Edit

</a>



<a 
href="kategori.php?hapus=<?= $row['id_kategori']; ?>"
onclick="return confirm('Hapus kategori?')"
class="hapus">

Hapus

</a>



</td>


</tr>


<?php } ?>


</table>



</div>


</body>

</html>