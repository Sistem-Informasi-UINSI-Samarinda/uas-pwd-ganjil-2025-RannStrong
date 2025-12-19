<?php
require "session.php";
require "../koneksi.php";
$id = $_GET['q'];
$data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM jersey WHERE id='$id'"));
$kats = mysqli_query($conn, "SELECT * FROM kategori");

if(isset($_POST['update'])){
    $nama = $_POST['nama']; $kat = $_POST['kategori']; $harga = $_POST['harga'];
    $stok = $_POST['stok']; $detail = $_POST['detail'];
    $foto_lama = $data['foto'];
    if($_FILES['foto']['name'] != ""){
        $foto_lama = time()."_".$_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], "../image/".$foto_lama);
    }
    mysqli_query($conn, "UPDATE jersey SET kategori_id='$kat', nama='$nama', harga='$harga', foto='$foto_lama', detail='$detail', ketersediaan_stok='$stok' WHERE id='$id'");
    header("location: produk.php");
}
if(isset($_POST['hapus'])){
    mysqli_query($conn, "DELETE FROM jersey WHERE id='$id'");
    header("location: produk.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
    <link rel="stylesheet" href="../css/style2.css">
</head>
<body>
    <?php include "navbar.php"; ?>
    <div class="container">
        <h3>Edit Produk</h3>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="text" name="nama" value="<?php echo $data['nama']; ?>">
            <select name="kategori">
                <?php while($k=mysqli_fetch_array($kats)){ ?>
                    <option value="<?php echo $k['id']; ?>" <?php if($k['id']==$data['kategori_id']) echo 'selected'; ?>><?php echo $k['nama']; ?></option>
                <?php } ?>
            </select>
            <input type="number" name="harga" value="<?php echo $data['harga']; ?>">
            <img src="../image/<?php echo $data['foto']; ?>" width="100"><br>
            <input type="file" name="foto">
            <textarea name="detail"><?php echo $data['detail']; ?></textarea>
            <select name="stok">
                <option value="tersedia" <?php if($data['ketersediaan_stok']=='tersedia') echo 'selected'; ?>>Tersedia</option>
                <option value="habis" <?php if($data['ketersediaan_stok']=='habis') echo 'selected'; ?>>Habis</option>
            </select>
            <button type="submit" name="update" class="btn btn-info">Update</button>
            <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
        </form>
    </div>
</body>
</html>