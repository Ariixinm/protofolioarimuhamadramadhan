<?php
include "config/koneksi.php";

$password = password_hash("admin123", PASSWORD_DEFAULT);

mysqli_query($conn,"
UPDATE users
SET password='$password'
WHERE email='admin@gmail.com'
");

echo "Password admin berhasil diupdate.";