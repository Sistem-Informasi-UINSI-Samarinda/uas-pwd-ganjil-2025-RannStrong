<?php
require "session.php";
require "../koneksi.php";

if(isset($_POST['simpan_kategori'])){
    $kategori = mysqli_real_escape_string($conn, htmlspecialchars($_POST['kategori']));
    mysqli_query($conn, "INSERT INTO kategori (nama) VALUES ('$kategori')");
    header("location: kategori.php");
}

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kategori | Manchester United</title>
    <link rel="stylesheet" href="../css/style2.css">
</head>
<body>
    <?php include "navbar.php"; ?>
    <div class="container">
        <h3>Tambah Kategori Jersey</h3>
        <form action="" method="post" style="max-width: 400px;">
            <input type="text" name="kategori" placeholder="Nama Kategori" required>
            <button type="submit" name="simpan_kategori" class="btn btn-primary">Simpan</button>
        </form>

        <table>
            <tr><th>No</th><th>Nama Kategori</th><th>Aksi</th></tr>
            <?php $no=1; while($data = mysqli_fetch_array($queryKategori)){ ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['nama']; ?></td>
                <td><a href="kategori-detail.php?q=<?php echo $data['id']; ?>" class="btn btn-info">Edit</a></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>