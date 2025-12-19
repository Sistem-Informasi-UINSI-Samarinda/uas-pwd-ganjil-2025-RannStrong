<?php
require "koneksi.php";
// Mengambil 6 produk terbaru dari tabel jersey
$queryProduk = mysqli_query($conn, "SELECT * FROM jersey LIMIT 6");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MU Store | Official Merchandise</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include "navbar-users.php"; ?>

    <div class="banner">
        <h1 style="font-size: 3.5rem; color: #FBE122; margin: 0; text-transform: uppercase;">United Store</h1>
        <p style="font-size: 1.2rem; letter-spacing: 2px; text-transform: uppercase;">Authentic Manchester United Merchandise</p>
        
        <form action="produk.php" method="get" class="search-container">
            <input type="text" name="keyword" class="search-input" placeholder="Cari Jersey favoritmu...">
            <button type="submit" class="btn-search">CARI</button>
        </form>
    </div>

    <div class="container">
        <h2 style="border-left: 5px solid #DA291C; padding-left: 15px; margin-top: 40px; text-transform: uppercase;">Produk Terpopuler</h2>
        
        <div class="game-grid">
            <?php while($data = mysqli_fetch_array($queryProduk)){ ?>
            <div class="game-card">
                <img src="image/<?php echo $data['foto']; ?>" alt="Jersey">
                <div class="card-content">
                    <h3><?php echo $data['nama']; ?></h3>
                    <p class="game-price">Rp <?php echo number_format($data['harga']); ?></p>
                    <a href="payment.php?id=<?php echo $data['id']; ?>" class="btn-buy">BELI SEKARANG</a>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    <div class="about-section">
        <div class="container">
            <h2>TENTANG KAMI</h2>
            <p>
                Selamat datang di United Store, penyedia jersey Manchester United terlengkap. 
                Kami berkomitmen memberikan kualitas terbaik bagi para fans setia Setan Merah di Indonesia. 
                Semua produk kami dipilih dengan standar kualitas tinggi untuk kepuasan Anda.
            </p>
        </div>
    </div>
</body>
</html>