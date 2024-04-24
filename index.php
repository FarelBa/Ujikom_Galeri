<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require 'function.php';
$foto = query("SELECT * FROM foto");


function jumlah_komen($foto_id)
{
    global $conn;
    $r = mysqli_query($conn, "SELECT COUNT(*) AS jumlah_komen FROM komentar_foto WHERE foto_id = $foto_id");
    $row = mysqli_fetch_assoc($r);
    return $row['jumlah_komen']; 
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
    <title>Home - PixaPort</title>
    <div id="home"></div>
</head>
<body>
    <div class="nav">
        <nav>
            <div class="logo"><a href="index.php">PixaPort</a></div>
            <div class="home"><a href="#home">Home</a></div>
            <div class="galeri"><a href="#galeri">Galeri</a></div>
            <div class="about"><a href="#about">About</a></div>
            <div class="logout"><a href="logout.php">logout</a></div>
        </nav>
    </div>
    <div class="head">
        <div class="title">
            <label for="">PixaPort</label>
        </div>
        <div class="dekstitle">
            <label for="">PixaPort adalah sebuah platform galeri foto berbasis website yang menawarkan pengalaman lengkap dalam mengelola, menampilkan, dan berbagi koleksi foto</label>
        </div>
    </div>
    <div id="galeri"></div>
    <div class="upload">
        <a href="tambah.php">
        <span class="material-symbols-outlined">add_box</span>
        <label for="">Upload Gambar</label>
        </a>
    </div>
    
    <div class="galeri">
        <h1>Galeri</h1>
    </div>
    <div class="bgfoto">
    <?php foreach ($foto as $row) : ?>
        <a href="preview.php?id=<?= $row["foto_id"]; ?>">
            <div class="foto">
                <div class="idfoto">
                    <?= $i; ?>
                </div>
                <div class="img">
                    <img src="img/<?= $row["lokasi_file"]; ?>" width="50" height="auto">
                </div>
                <div class="bgcaption">
                    <div class="judul"><label for="judul"><?= $row["judul_foto"]; ?></label></div>
                    <div class="tanggal"><label for="tanggal"><?= $row["tanggal_unggah"]; ?></label></div><br>
                    <div class="deskripsi"><label for="deskripsi"><?= $row["deskripsi_foto"]; ?></label></div>
                </div>
                <div class="likeedit">
                    <div class="like">
                    <a href="like.php?foto_id=<?= $row['foto_id'] ?>">
                        <?php if (likeafter($row['foto_id'])) : ?>
                            <img src="img/like_after.png" alt="">
                        <?php else : ?>
                            <img src="img/like_before.png" alt="">
                        <?php endif; ?>
                        
                        <?= jumlah_like($row['foto_id']) ?>
                    </a> 
           
                        <a href="preview.php?id=<?= $row["foto_id"]; ?>"><img src="img/komen.png" alt=""><?= jumlah_komen($row['foto_id']) ?></a>
                    </div>
                    <?php if ($_SESSION["user_id"] == $row["user_id"]) : ?>
                        
                    <div class="edit">
                        <a onclick="return confirm('Benernih Mau Di Hapus?')" href="hapus.php?foto_id=<?= $row['foto_id'] ?>"><span class="material-symbols-outlined">delete</span></a>
                        <a href="edit.php?id=<?= $row["foto_id"]; ?>"><span class="material-symbols-outlined">edit_square</span></a></div>
                    <?php endif; ?>
                </div>
            </div>
        </a>
</body>
    <?php endforeach; ?>
</div>
<div id="about"></div>
<div class="footer">
    <div class="about"><h1>About</h1></div>
    <div class="isiabout">
        <div class="titleabout">
            <label for=""><b>PixaPort</b> dipilih sebagai nama untuk aplikasi galeri foto berbasis website karena menggabungkan unsur-unsur yang relevan dan menarik.</label>
        </div>
        <ol>
            <li><b>Pixa</b> mengacu pada <b>piksel</b>, unit dasar dalam representasi gambar digital. Ini mencerminkan fokus utama aplikasi pada foto dan gambar.</li>
            <li><b>Port</b> singkatan dari <b>"portfolio"</b>, yang menunjukkan bahwa platform ini bukan hanya sekadar penyimpanan foto, tetapi juga merupakan tempat bagi pengguna untuk memamerkan karya mereka dengan cara yang profesional.</li>
            <li><b>Port</b> juga merujuk pada <b>"portal"</b> atau <b>"gateway"</b>, menyoroti peran <b>PixaPort</b> sebagai pintu gerbang untuk memasuki dunia koleksi gambar dan fotografi yang luas.</li>
            <li>Secara keseluruhan, nama <b>PixaPort</b> memberikan kesan tentang tempat yang dinamis dan kreatif untuk <b>mengeksplorasi, mengatur,</b> dan <b>berbagi foto,</b> sambil menekankan kualitas visual dan aspek portofolio dari pengalaman pengguna.</li>
        </ol>
    </div>
</div>
<footer>
    <div class="copyright">
        PixaPort
        <label for="">@2024</label>
    </div>
</footer>