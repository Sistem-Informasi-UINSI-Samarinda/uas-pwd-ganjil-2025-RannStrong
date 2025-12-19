<?php
require "session.php";
require "../koneksi.php";
$id = $_GET['q'];
$data = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM kategori WHERE id='$id'"));

if(isset($_POST['edit'])){
    $nama = $_POST['kategori'];
    mysqli_query($conn, "UPDATE kategori SET nama='$nama' WHERE id='$id'");
    header("location: kategori.php");
}
if(isset($_POST['hapus'])){
    mysqli_query($conn, "DELETE FROM kategori WHERE id='$id'");
    header("location: kategori.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Kategori</title>
    <link rel="stylesheet" href="../css/style2.css">
</head>
<body>
    <?php include "navbar.php"; ?>
    <div class="container">
        <h3>Detail Kategori</h3>
        <form action="" method="post">
            <input type="text" name="kategori" value="<?php echo $data['nama']; ?>">
            <button type="submit" name="edit" class="btn btn-info">Update</button>
            <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
        </form>
    </div>
</body>
</html>