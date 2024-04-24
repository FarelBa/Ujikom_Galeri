<?php
session_start();

if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}
require 'function.php';

// cek apakah tombol submit sudah ditekan atau belum
if( isset($_POST["submit"]) ) {
	
	// cek apakah data berhasil di tambahkan atau tidak
	if( tambah($_POST) > 0 ) {
		echo "
			<script>
				alert('data berhasil ditambahkan!');
				document.location.href = 'index.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('data gagal ditambahkan!');
				document.location.href = 'index.php';
			</script>
		";
	}
}
function tambah($data) {
	global $conn;

	$judul_foto = htmlspecialchars($data["judul_foto"]);
	$deskripsi_foto = htmlspecialchars($data["deskripsi_foto"]);
	$user_id = $_SESSION["user_id"];
	
	$lokasi_file = upload();
	if( !$lokasi_file ) {
		return false;
	}
	// $user_id = htmlspecialchars($data["user_id"]);

	$query = "INSERT INTO foto
				VALUES
			  ('', '$judul_foto', '$deskripsi_foto', current_timestamp(), '$lokasi_file', '$user_id')
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="style.css">
    <title>Upload - PixaPort</title>
</head>
<body>
    <div class="bgbgform">

        <div class="bgformupload">
            <div class="titleform">
                <label for="Upload Gambar">Upload Gambar</label>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="flex12">

                    <label for="input-file" id="drop-area">
                        <input type="file" accept="image/*" name="lokasi_file" id="input-file" hidden>
                        <div id="img-view">
                            <img src="img/icon.png">
                            <p>seret dan lepas <br>atau klik di sini</p>
                        </div>
                    </label>
                    <div class="gridinput">
                        <div class="inputtambah1">
                            <input type="text" name="judul_foto" placeholder="Judul">
                        </div>
                        <div class="inputtambah2">
                            <input type="text" name="deskripsi_foto" placeholder="Deskripsi">
                        </div>
                        <input type="hidden" name="user_id" value="1">
                    </div>
                </div>
                    <button type="submit" name="submit">Upload</button>
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