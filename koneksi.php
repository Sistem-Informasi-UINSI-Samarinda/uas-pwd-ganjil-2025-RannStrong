<?php
$conn = mysqli_connect("localhost", "root", "", "united_store");

if (mysqli_connect_errno()) {
    echo "Koneksi database gagal : " . mysqli_connect_error();
    exit();
}
?>