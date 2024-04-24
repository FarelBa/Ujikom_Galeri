<?php

$foto_id = $_GET["foto_id"];

include 'function.php';

// Menghapus data dari tabel komentar_foto yang memiliki foto_id yang sama
mysqli_query($conn, "DELETE FROM komentar_foto WHERE foto_id = $foto_id");

// Menghapus data dari tabel like_foto yang memiliki foto_id yang sama
mysqli_query($conn, "DELETE FROM like_foto WHERE foto_id = $foto_id");

// Menghapus data dari tabel foto berdasarkan foto_id yang diberikan
mysqli_query($conn, "DELETE FROM foto WHERE foto_id = $foto_id");

// Mengarahkan kembali ke halaman index setelah penghapusan
header('location: index.php');

?>
