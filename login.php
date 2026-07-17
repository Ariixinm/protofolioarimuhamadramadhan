<?php
session_start();
require_once "config/koneksi.php";

$error = "";

if(isset($_POST['login'])){

    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = $_POST['password'];

    $query = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($query) > 0){

        $user = mysqli_fetch_assoc($query);

        if(password_verify($password,$user['password'])){

            $_SESSION['id_user'] = $user['id_user'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['level'] = $user['level'];
            $_SESSION['login'] = true; // <- tambahkan ini

           if($user['level']=="admin"){
    header("Location: admin/dashboard.php");
} elseif ($user['level']=="cs"){
    header("Location: cs/dashboard.php");
} else {
    header("Location: index.php");
}

            exit;

        }else{

            $error="Password salah.";

        }

    }else{

        $error="Email tidak ditemukan.";

    }

}
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Login UMKM Store</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<link rel="stylesheet" href="assets/css/login.css">

</head>

<body>

<div class="login-box">

<div class="card shadow-lg border-0">

<div class="row g-0">

<div class="col-lg-6 left-side">

<h1>UMKM STORE</h1>

<p>Dukung Produk Lokal Indonesia</p>

<img src="assets/img/lele.webp" class="img-fluid">

</div>

<div class="col-lg-6">

<div class="card-body p-5">

<h2 class="mb-4 text-center">
login

</h2>

<?php

if($error!=""){

?>

<div class="alert alert-danger">

<?php echo $error; ?>

</div>

<?php

}

?>

<form method="POST">

<div class="mb-3">

<label>Email</label>

<div class="input-group">

<span class="input-group-text">

<i class="fa fa-envelope"></i>

</span>

<input
type="email"
name="email"
class="form-control"
placeholder="Masukkan Email"
required>

</div>

</div>

<div class="mb-4">

<label>Password</label>

<div class="input-group">

<span class="input-group-text">

<i class="fa fa-lock"></i>

</span>

<input
type="password"
name="password"
class="form-control"
placeholder="Masukkan Password"
required>

</div>

</div>

<button
class="btn btn-success w-100"
name="login">

<i class="fa fa-sign-in-alt"></i>

Login

</button>

<a href="index.php" class="btn btn-outline-secondary w-100 mt-3">

Kembali

</a>
<div class="text-center mt-3">
    Belum punya akun?
    <a href="register.php">Daftar Sekarang</a>
</div>

</form>

</div>

</div>

</div>

</div>

</div>

</body>

</html>