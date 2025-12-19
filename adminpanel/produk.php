<?php
require "session.php";
require "../koneksi.php";

if(isset($_POST['simpan_produk'])){
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $detail = mysqli_real_escape_string($conn, $_POST['detail']);

    $nama_file = $_FILES['foto']['name'];
    $new_name = time() . "_" . basename($nama_file);
    move_uploaded_file($_FILES['foto']['tmp_name'], "../image/" . $new_name);

    mysqli_query($conn, "INSERT INTO jersey (kategori_id, nama, harga, foto, detail, ketersediaan_stok) 
                        VALUES ('$kategori', '$nama', '$harga', '$new_name', '$detail', '$stok')");
    header("location: produk.php");
}

$query = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori FROM jersey a JOIN kategori b ON a.kategori_id = b.id");
$queryKat = mysqli_query($conn, "SELECT * FROM kategori");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Produk | Manchester United</title>
    <link rel="stylesheet" href="../css/style2.css">
</head>
<body>
    <?php include "navbar.php"; ?>
    <div class="container">
        <h2>Tambah Jersey Baru</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="text" name="nama" placeholder="Nama Jersey" required>
            <select name="kategori" required>
                <option value="">-- Pilih Kategori --</option>
                <?php while($dk=mysqli_fetch_array($queryKat)){ echo "<option value='$dk[id]'>$dk[nama]</option>"; } ?>
            </select>
            <input type="number" name="harga" placeholder="Harga" required>
            <input type="file" name="foto">
            <textarea name="detail" placeholder="Deskripsi"></textarea>
            <select name="stok">
                <option value="tersedia">Tersedia</option>
                <option value="habis">Habis</option>
            </select>
            <button type="submit" name="simpan_produk" class="btn btn-primary">Simpan Produk</button>
        </form>

        <table>
            <tr><th>No</th><th>Foto</th><th>Nama</th><th>Kategori</th><th>Harga</th><th>Aksi</th></tr>
            <?php $no=1; while($data=mysqli_fetch_array($query)){ ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><img src="../image/<?php echo $data['foto']; ?>" width="60"></td>
                <td><?php echo $data['nama']; ?></td>
                <td><?php echo $data['nama_kategori']; ?></td>
                <td>Rp <?php echo number_format($data['harga'], 0, ',', '.'); ?></td>
                <td><a href="produk-detail.php?q=<?php echo $data['id']; ?>" class="btn btn-info">Edit</a></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>