<?php
require "koneksi.php";
$keyword = $_GET['keyword'] ?? '';
$query = "SELECT * FROM jersey";
if($keyword) {
    $query .= " WHERE nama LIKE '%$keyword%'";
}
$queryAll = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Katalog Jersey | MU Store</title>
</head>
<body>
    <?php include "navbar-users.php"; ?>
    <div class="container" style="margin-top: 30px;">
        <h1 style="color: #DA291C; border-bottom: 2px solid #333; padding-bottom: 10px;">SEMUA PRODUK</h1>
        <div class="game-grid">
            <?php while($row = mysqli_fetch_array($queryAll)){ ?>
            <div class="game-card">
                <img src="image/<?php echo $row['foto']; ?>">
                <div class="card-content">
                    <h3><?php echo $row['nama']; ?></h3>
                    <p class="game-price">Rp <?php echo number_format($row['harga']); ?></p>
                    <a href="payment.php?id=<?php echo $row['id']; ?>" class="btn-buy">BELI</a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>