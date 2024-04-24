<?php
include 'function.php';
session_start();

$foto_id = $_GET['foto_id'];
$user_id = $_SESSION["user_id"];
$tanggal_like = date('Y-m-d');

$q = mysqli_query($conn, "SELECT * FROM like_foto WHERE foto_id = $foto_id AND user_id = $user_id");

if (mysqli_num_rows($q) > 0) {
    mysqli_query($conn, "DELETE FROM like_foto WHERE foto_id = $foto_id AND user_id = $user_id");
} else {
    mysqli_query($conn, "INSERT INTO like_foto VALUES ('', '$foto_id', '$user_id', '$tanggal_like')");
}


header('location: index.php');
?>