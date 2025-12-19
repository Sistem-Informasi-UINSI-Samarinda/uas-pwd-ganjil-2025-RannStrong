<?php
session_start();
require "koneksi.php";

$item = null;
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $q = mysqli_query($conn, "SELECT * FROM jersey WHERE id='$id'");
    if($q && mysqli_num_rows($q) > 0) { $item = mysqli_fetch_array($q); }
}

if (isset($_POST['proses_bayar'])) {
    $nama_pembeli = mysqli_real_escape_string($conn, $_POST['nama_pembeli']);
    $email        = mysqli_real_escape_string($conn, $_POST['email']);
    $alamat       = mysqli_real_escape_string($conn, $_POST['alamat']);
    $nama_produk  = mysqli_real_escape_string($conn, $_POST['nama_item']);
    $harga        = $_POST['harga_item'];
    $metode       = $_POST['metode'];

    $querySimpan = mysqli_query($conn, "INSERT INTO pesanan (nama_pembeli, email, alamat_pengiriman, nama_produk, harga, metode_bayar) 
                                        VALUES ('$nama_pembeli', '$email', '$alamat', '$nama_produk', '$harga', '$metode')");

    if ($querySimpan) {
        echo "<script>alert('Pembelian Berhasil!'); window.location='payment.php';</script>";
    }
}
$riwayat = mysqli_query($conn, "SELECT * FROM pesanan ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment & Riwayat | MU Store</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include "navbar-users.php"; ?>

    <div class="container">
        <?php if ($item): ?>
        <div class="payment-box">
            <h2>FORMULIR PENGIRIMAN & PEMBAYARAN</h2>
            <p style="margin-bottom: 20px;">Produk: <b><?php echo $item['nama']; ?></b> (Rp <?php echo number_format($item['harga']); ?>)</p>
            
            <form method="POST">
                <input type="hidden" name="nama_item" value="<?php echo $item['nama']; ?>">
                <input type="hidden" name="harga_item" value="<?php echo $item['harga']; ?>">
                
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_pembeli" placeholder="Nama penerima..." required>
                </div>
                <div class="form-group">
                    <label>Email Aktif</label>
                    <input type="email" name="email" placeholder="Alamat email..." required>
                </div>
                <div class="form-group">
                    <label>Alamat Lengkap Pengiriman</label>
                    <textarea name="alamat" rows="3" placeholder="Jalan, No. Rumah, Kota, Kode Pos..." required></textarea>
                </div>
                <div class="form-group">
                    <label>Metode Pembayaran</label>
                    <select name="metode" required>
                        <option value="">-- Pilih --</option>
                        <option value="DANA">DANA</option>
                        <option value="OVO">OVO</option>
                        <option value="Transfer Bank">Transfer Bank</option>
                    </select>
                </div>
                <button type="submit" name="proses_bayar" class="btn-buy">KONFIRMASI DAN BAYAR</button>
            </form>
        </div>
        <?php endif; ?>

        <h2 style="margin-top: 50px; color: var(--mu-gold);">RIWAYAT TRANSAKSI TERBARU</h2>
        <div class="table-container">
            <table class="table-history">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pembeli</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Produk</th>
                        <th>Total</th>
                        <th>Metode</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1; 
                    while($res = mysqli_fetch_array($riwayat)){ 
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $res['nama_pembeli']; ?></td>
                        <td><?php echo $res['email']; ?></td>
                        <td><?php echo $res['alamat_pengiriman']; ?></td>
                        <td><?php echo $res['nama_produk']; ?></td>
                        <td>Rp <?php echo number_format($res['harga']); ?></td>
                        <td><b><?php echo $res['metode_bayar']; ?></b></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>