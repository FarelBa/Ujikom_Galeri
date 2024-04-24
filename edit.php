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

// cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"]) ) {
	
	// cek apakah data berhasil di tambahkan atau tidak
	if( ubah($_POST) > 0 ) {
		echo "
			<script>
				alert('data berhasil diedit!');
				document.location.href = 'index.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal diedit!');
				document.location.href = 'index.php';
			</script>
		";
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="style.css">
    <title>Edit Foto - PixaPort</title>
</head>
<body>
    <div class="bgbgform">

        <div class="bgformupload">
            <div class="titleform">
                <label for="Upload Gambar">Edit Gambar</label>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="foto_id" value="<?= $foto["foto_id"]; ?>">
                <div class="flex12">

                    <label for="input-file" id="drop-area">
                        <div id="img-view-edit" >
                            <img src="img/<?= $foto["lokasi_file"]; ?>" alt="<?= $foto["judul_foto"]; ?>">
                        </div>
                    </label>
                    <div class="gridinput">
                        <div class="inputtambah1">
                            <input type="text" name="judul_foto" placeholder="Judul" value="<?= $foto["judul_foto"]; ?>">
                        </div>
                        <div class="inputtambah2">
                            <input type="text" name="deskripsi_foto" placeholder="Deskripsi" value="<?= $foto["deskripsi_foto"]; ?>">
                        </div>
                        <input type="hidden" name="user_id" value="1">
                    </div>
                </div>
                    <button type="submit" name="submit">Edit</button>
            </form>
        </div>
    </div>
</body>
</html>
    <script>
        const dropArea = document.getElementById("drop-area");
        const inputFile = document.getElementById("input-file");
        const imageView = document.getElementById("img-view");

        inputFile.addEventListener("change", uploadImage);

        function uploadImage(){
            let imgLink = URL.createObjectURL(inputFile.files[0]);
            imageView.style.backgroundImage = `url(${imgLink})`;
            imageView.textContent = "";
            imageView.style.border = 0;
        }
        dropArea.addEventListener("dragover", function(e){
            e.preventDefault();
        });
        dropArea.addEventListener("drop", function(e){
            e.preventDefault();
            inputFile.files = e.dataTransfer.files;
            uploadImage();
        });
    </script>