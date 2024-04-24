<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}
require 'function.php'; 

$foto_id = $_GET["id"];

// query data mahasiswa berdasarkan foto_id
$foto = query("SELECT * FROM foto WHERE foto_id = $foto_id")[0];

function getkomentar($foto_id)
{
    global $conn;
    $s = mysqli_query($conn, "SELECT * FROM komentar_foto WHERE foto_id = $foto_id");
    return mysqli_fetch_all($s, MYSQLI_ASSOC);
}

$komen = getkomentar($foto['foto_id']);


function nama_user($user_id)
{
    global $conn;
    $r = mysqli_query($conn, "SELECT * FROM user WHERE user_id = $user_id");
    $row = mysqli_fetch_assoc($r);
    return $row['username']; 
}
function likeafter($foto_id) {
    global $conn;
    $user_id = $_SESSION["user_id"];
    $query = mysqli_query($conn, "SELECT * FROM like_foto WHERE foto_id = $foto_id AND user_id = $user_id");
    return mysqli_num_rows($query) > 0; // Mengembalikan true jika ada hasil kueri, false jika tidak
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="style.css">
    <title>Preview - PixaPort</title>
</head>
<body>
    <div class="kembalibutton">
        <a href="index.php">
            <img src="img/backbutton.png" alt="">
        </a>
    </div>
    <div class="bgpre">
        <img src="img/<?= $foto["lokasi_file"]; ?>" alt="">
        <div class="judulpre"><label for="judulpre"><?= $foto["judul_foto"]; ?></label></div>
        <div class="likepre">
            <a href="likepreview.php?foto_id=<?= $foto['foto_id'] ?>">
                <?php if (likeafter($foto['foto_id'])) : ?>
                    <img src="img/like_after.png" alt="">
                <?php else : ?>
                    <img src="img/like_before.png" alt="">
                <?php endif; ?>    
                <?= jumlah_like($foto['foto_id']) ?>
            </a>    
        </div><br>
        <div class="deskripsipre"><?= $foto["deskripsi_foto"]; ?></div>
        <div class="batas">
            <div class="akunpre"><label for="akunpre"><?= nama_user($foto["user_id"]) ?></label></div> 
            <div class="aksibuttonpre">
                <?php if ($_SESSION["user_id"] == $foto["user_id"]) : ?>
                    <a onclick="return confirm('Benernih Mau Di Hapus?')" href="hapus.php?foto_id=<?= $foto['foto_id'] ?>"><span class="material-symbols-outlined">delete</span></a>
                    <a href="edit.php?id=<?= $foto["foto_id"]; ?>"><span class="material-symbols-outlined">edit_square</span></a>
                <?php endif; ?>
            </div>
            <div class="tanggalpre"><?= $foto["tanggal_unggah"]; ?></div>
        </div>
        <div class="garisbatas">
            <hr class="hr1">
            <label for="">komentar</label>
            <hr class="hr2">
        </div>
        <?php if (empty($komen)) : ?>
            <div class="akunkomenpre">
                <p>Belum ada komentar.</p>
            </div>
        <?php else : ?>
            <?php foreach ($komen as $row) : ?>
                <div class="akunkomenpre">
                    <div class="left">
                        <div class="namaakunkomenpre"><label for=""><?= nama_user($row["user_id"]) ?></label></div>
                        <div class="tanggalkomenpre"><label for=""><?= $row['tanggal_komentar'] ?></label></div>
                    </div>
                    <div class="right">
                        <div class="isikomenpre"><label for=""><?= $row['isi_komentar'] ?></label></div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <div class="formkomen">
            <form action="komen.php" method="post">
                <input type="hidden" name="foto_id" value="<?= $foto['foto_id'] ?>">
                <input type="text" name="isi_komentar" placeholder="komentar">
                <button type="submit" name="submit"><span class="material-symbols-outlined">send</span></button>
            </form>
        </div>
    </div>
</body>
</html>