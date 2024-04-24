<?php

session_start();
include 'function.php';

$user_id = $_SESSION["user_id"];
$foto_id = $_POST['foto_id'];
$isi_komentar = $_POST['isi_komentar'];
$tanggal_komentar = date('Y-m-d');

mysqli_query($conn, "INSERT INTO komentar_foto VALUES ('', '$foto_id', '$user_id', '$isi_komentar', '$tanggal_komentar')");

echo "<script>
        window.location = 'preview.php?id=$foto_id';
      </script>";

?>