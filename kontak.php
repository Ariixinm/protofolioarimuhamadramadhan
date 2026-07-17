<?php
session_start();
include "config/koneksi.php";

$pesan = "";

if(isset($_POST['kirim'])){

    $nama = mysqli_real_escape_string($conn, trim($_POST['nama'] ?? ''));
    $email = mysqli_real_escape_string($conn, trim($_POST['email'] ?? ''));
    $no_hp = mysqli_real_escape_string($conn, trim($_POST['no_hp'] ?? ''));
    $subjek = mysqli_real_escape_string($conn, trim($_POST['subjek'] ?? ''));
    $isi_pesan = mysqli_real_escape_string($conn, trim($_POST['pesan'] ?? ''));

    $no_hp = substr($no_hp, 0, 20);

    $sql = "INSERT INTO kontak(nama,email,no_hp,subjek,pesan)
            VALUES('$nama','$email','$no_hp','$subjek','$isi_pesan')";

    if(mysqli_query($conn,$sql)){
        $pesan = "<div class='alert alert-success'>Pesan berhasil dikirim.</div>";
    }else{
        $pesan = "<div class='alert alert-danger'>Pesan gagal dikirim.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Kontak Kami</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/kontak.css">
</head>
<body>

<div class="container mt-5">

<h2>Hubungi Kami</h2>

<?= $pesan; ?>

<form method="post">

<div class="mb-3">
<label>Nama</label>
<input type="text" name="nama" class="form-control" required>
</div>

<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>

<div class="mb-3">
<label>No. HP</label>
<input type="text" name="no_hp" class="form-control" required>
</div>

<div class="mb-3">
<label>Subjek</label>
<input type="text" name="subjek" class="form-control">
</div>

<div class="mb-3">
<label>Pesan</label>
<textarea name="pesan" rows="5" class="form-control" required></textarea>
</div>

<button type="submit" name="kirim" class="btn btn-success">
Kirim Pesan
</button>

</form>

</div>

</body>
</html>