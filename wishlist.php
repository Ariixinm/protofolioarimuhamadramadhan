<?php
session_start();

if (!isset($_SESSION['wishlist'])) {
    $_SESSION['wishlist'] = [];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/wishlist.css">
</head>
<body>

<div class="container mt-5">

    <h2 class="mb-4 text-center">❤️ Wishlist Saya</h2>

    <?php if (count($_SESSION['wishlist']) == 0) { ?>

    <tr>

<td width="120">

    <img src="uploads/<?= $item['gambar']; ?>"
    width="100">

</td>
        <div class="alert alert-warning text-center">
            Wishlist masih kosong.
        </div>

    <?php } else { ?>

    <table class="table table-bordered table-hover">

        <thead class="table-success">

            <tr>

                <th>Gambar</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Aksi</th>

            </tr>

        </thead>

        <tbody>

        <?php foreach($_SESSION['wishlist'] as $item){ ?>

            <tr>

                <td width="120">
<?php
$gambar = "uploads/" . $item['gambar'];

if (empty($item['gambar']) || !file_exists($gambar)) {
    $gambar = "assets/uploads/bakar.jpg";
}
?>

<img src="<?= $gambar; ?>" 
     width="100"
     height="100"
     style="object-fit:cover; border-radius:10px;">

</td>       

                </td>

                <td><?= $item['nama']; ?></td>

                <td>
                    Rp <?= number_format($item['harga'],0,',','.'); ?>
                </td>

                <td>

                    <a href="tambah_keranjang.php?id=<?= $item['id_produk']; ?>"
                    class="btn btn-success btn-sm">
                        Masukkan Keranjang
                    </a>

                    <a href="hapus_wishlist.php?id=<?= $item['id_produk']; ?>"
                    class="btn btn-danger btn-sm">
                        Hapus
                    </a>

                </td>

            </tr>

        <?php } ?>

        </tbody>

    </table>

    <?php } ?>

    <a href="index.php" class="btn btn-primary">
        Kembali Belanja
    </a>

</div>

</body>
</html>