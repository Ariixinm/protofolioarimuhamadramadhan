<?php
session_start();
require_once "../config/koneksi.php";

// Ambil data kategori
$kategori = mysqli_query($conn, "SELECT * FROM kategori ORDER BY nama_kategori ASC");

// Simpan produk
if(isset($_POST['simpan'])){

    $id_kategori = (int)$_POST['id_kategori'];
    $nama_produk = mysqli_real_escape_string($conn, $_POST['nama_produk']);
    $deskripsi   = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $harga       = (int)$_POST['harga'];
    $stok        = (int)$_POST['stok'];

    $gambar = "";

    // Upload gambar
    if(!empty($_FILES['gambar']['name'])){

        $ext = strtolower(pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION));

        $allowed = ['jpg','jpeg','png','webp'];

        if(in_array($ext, $allowed)){

            $gambar = time() . "." . $ext;

            move_uploaded_file(
                $_FILES['gambar']['tmp_name'],
                "../assets/uploads/" . $gambar
            );

        }

    }

    mysqli_query($conn,"
        INSERT INTO produk
        (
            id_kategori,
            nama_produk,
            deskripsi,
            harga,
            stok,
            gambar
        )
        VALUES
        (
            '$id_kategori',
            '$nama_produk',
            '$deskripsi',
            '$harga',
            '$stok',
            '$gambar'
        )
    ");

    echo "<script>
    alert('Produk berhasil ditambahkan');
    window.location='produk.php';
    </script>";

}
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Tambah Produk</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container py-5">

<div class="card shadow">

<div class="card-header bg-success text-white">

<h3>
<i class="fas fa-plus-circle"></i>
Tambah Produk
</h3>

</div>

<div class="card-body">

<form method="POST" enctype="multipart/form-data">

<div class="mb-3">

<label class="form-label">
Nama Produk
</label>

<input
type="text"
name="nama_produk"
class="form-control"
required>

</div>

<div class="mb-3">

<label class="form-label">
Kategori
</label>

<select
name="id_kategori"
class="form-select"
required>

<option value="">-- Pilih Kategori --</option>

<?php while($k = mysqli_fetch_assoc($kategori)){ ?>

<option value="<?= $k['id_kategori']; ?>">

<?= htmlspecialchars($k['nama_kategori']); ?>

</option>

<?php } ?>

</select>

</div>

<div class="mb-3">

<label class="form-label">
Harga
</label>

<input
type="number"
name="harga"
class="form-control"
required>

</div>

<div class="mb-3">

<label class="form-label">
Stok
</label>

<input
type="number"
name="stok"
class="form-control"
required>

</div>

<div class="mb-3">

<label class="form-label">
Deskripsi
</label>

<textarea
name="deskripsi"
rows="5"
class="form-control"
required></textarea>

</div>

<div class="mb-3">

<label class="form-label">
Upload Gambar
</label>

<input
type="file"
name="gambar"
accept=".jpg,.jpeg,.png,.webp"
class="form-control">

</div>

<button
type="submit"
name="simpan"
class="btn btn-success">

<i class="fas fa-save"></i>

Simpan

</button>

<a
href="produk.php"
class="btn btn-secondary">

<i class="fas fa-arrow-left"></i>

Kembali

</a>

</form>

</div>

</div>

</div>

</body>
</html>