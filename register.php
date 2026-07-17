<?php
session_start();
require_once "config/koneksi.php";

$pesan = "";
$error = "";

if(isset($_POST['register'])){

    $nama     = htmlspecialchars(trim($_POST['nama']));
    $email    = htmlspecialchars(trim($_POST['email']));
    $no_hp    = htmlspecialchars(trim($_POST['no_hp']));
    $alamat   = htmlspecialchars(trim($_POST['alamat']));
    $password = $_POST['password'];
    $konfirmasi = $_POST['konfirmasi'];

    // Cek email
    $cek = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($cek)>0){

        $error = "Email sudah terdaftar.";

    }elseif($password != $konfirmasi){

        $error = "Konfirmasi password tidak sama.";

    }else{

       $passwordHash = password_hash($password, PASSWORD_DEFAULT);

$simpan = mysqli_query($conn,"INSERT INTO users
(nama,email,password,no_hp,alamat,foto,level)
VALUES
('$nama','$email','$passwordHash','$no_hp','$alamat','default.png','customer')");

        if($simpan){

            $_SESSION['success']="Registrasi berhasil. Silakan login.";

            header("Location: login.php");
            exit;

        }else{

            $error="Registrasi gagal.";

        }

    }

}
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Register UMKM Store</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<link rel="stylesheet" href="assets/css/register.css">

</head>

<body>

<div class="container">

<div class="row justify-content-center">

<div class="col-lg-7">

<div class="card shadow-lg border-0 mt-5">

<div class="card-header bg-success text-white text-center">

<h2>Daftar Akun UMKM Store</h2>

</div>

<div class="card-body p-4">

<?php if($error!=""){ ?>

<div class="alert alert-danger">

<?= $error ?>

</div>

<?php } ?>

<form method="POST">

<div class="row">

<div class="col-md-6 mb-3">

<label>Nama Lengkap</label>

<input
type="text"
name="nama"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
required>

</div>

</div>

<div class="row">

<div class="col-md-6 mb-3">

<label>No HP</label>

<input
type="text"
name="no_hp"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Alamat</label>

<input
type="text"
name="alamat"
class="form-control"
required>

</div>

</div>

<div class="row">

<div class="col-md-6 mb-3">

<label>Password</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label>Konfirmasi Password</label>

<input
type="password"
name="konfirmasi"
class="form-control"
required>

</div>

</div>

<button
type="submit"
name="register"
class="btn btn-success w-100">

<i class="fa fa-user-plus"></i>

Daftar

</button>

<a href="login.php"
class="btn btn-outline-secondary w-100 mt-3">

Sudah punya akun? Login

</a>

</form>

</div>

</div>

</div>

</div>

</div>

</body>
</html>