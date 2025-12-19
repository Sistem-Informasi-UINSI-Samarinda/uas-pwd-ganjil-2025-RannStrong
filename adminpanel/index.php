<?php
require "session.php";
require "../koneksi.php"; 

$jmlKategori = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM kategori"));
$jmlJersey = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM jersey"));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard | Manchester United</title>
    <link rel="stylesheet" href="../css/style2.css">
</head>
<body>
    <?php include "navbar.php"; ?>
    <div class="container">
        <h1>Dashboard Admin</h1>
        <div class="row">
            <div class="card">
                <h3>Kategori</h3>
                <p><?php echo $jmlKategori; ?> Kategori Jersey</p>
                <a href="kategori.php" style="color: #DA291C;">Kelola Kategori</a>
            </div>
            <div class="card">
                <h3>Jersey</h3>
                <p><?php echo $jmlJersey; ?> Koleksi Produk</p>
                <a href="produk.php" style="color: #DA291C;">Kelola Produk</a>
            </div>
        </div>
    </div>
</body>
</html>