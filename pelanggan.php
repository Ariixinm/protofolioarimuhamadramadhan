<?php

include_once __DIR__ . "/../config/koneksi.php";


// HAPUS PELANGGAN

if(isset($_GET['hapus'])){

    $id = $_GET['hapus'];


    mysqli_query($conn,"
    DELETE FROM users
    WHERE id_user='$id'
    ");


    echo "
    <script>
    alert('Pelanggan berhasil dihapus');
    window.location='pelanggan.php';
    </script>
    ";

}



// PENCARIAN

$cari = "";

if(isset($_GET['cari'])){

    $cari = $_GET['cari'];

}



$query = mysqli_query($conn,"
SELECT *
FROM users

WHERE 
nama LIKE '%$cari%'
OR email LIKE '%$cari%'

ORDER BY id_user DESC
");


?>


<!DOCTYPE html>
<html>

<head>

<title>Data Pelanggan</title>

<link rel="stylesheet" href="assets/css/pelanggan.css">

</head>


<body>


<div class="container">


<div class="header">

<h2>
Data Pelanggan
</h2>


<a href="dashboard.php" class="btn">
Dashboard
</a>


</div>



<!-- SEARCH -->

<form class="search" method="GET">


<input 
type="text"
name="cari"
placeholder="Cari pelanggan..."
value="<?= $cari; ?>"
>


<button>
Cari
</button>


</form>



<table>


<tr>

<th>No</th>

<th>Nama</th>

<th>Email</th>

<th>No HP</th>

<th>Alamat</th>


<th>Aksi</th>

</tr>



<?php


$no=1;


while($row=mysqli_fetch_assoc($query)){


?>


<tr>


<td>
<?= $no++; ?>
</td>


<td>
<?= $row['nama']; ?>
</td>


<td>
<?= $row['email']; ?>
</td>


<td>
<?= $row['no_hp']; ?>
</td>


<td>
<?= $row['alamat']; ?>
</td>





<td>


<a 
href="pelanggan.php?hapus=<?= $row['id_user']; ?>"
onclick="return confirm('Hapus pelanggan?')"
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