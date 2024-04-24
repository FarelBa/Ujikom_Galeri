<?php 
require 'function.php';

if( isset($_POST["register"]) ) {

	if( registrasi($_POST) > 0 ) {
		echo "<script>
				alert('user baru berhasil ditambahkan!');
				document.location.href = 'index.php';
			  </script>";
	} else {
		echo mysqli_error($conn);
	}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Daftar - Pixaport</title>
</head>
<body>
    <div class="bgform">
        <div class="titleform"><label for="daftar">Daftar</label></div>
        <form action="" method="post">
            <div class="bginput">
                <input type="text" placeholder="Nama Lengkap" name="nama_lengkap">
                <input type="text" placeholder="Username" name="username">
                <input type="text" placeholder="Email" name="email">
                <input type="text" placeholder="Alamat" name="alamat">
                <input type="password" placeholder="Password" name="password">
                <input type="password" placeholder="Konfirmasi Password" name="password2">
            </div>
            <div class="bgbutton">
                <button type="submit" name="register">Daftar</button>
            </div>
        </form>
        <div class="garisbatas">
            <hr class="hr1">
            <label for="">Atau</label>
            <hr class="hr2">
        </div>
        <div class="bgatau">
            <a href="login.php">Login</a>
        </div>
    </div>
</body>
</html>