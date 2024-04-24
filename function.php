<?php 
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "ujikom_frel");


function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}

function upload() {

	$namaFile = $_FILES['lokasi_file']['name'];
	$ukuranFile = $_FILES['lokasi_file']['size'];
	$error = $_FILES['lokasi_file']['error'];
	$tmpName = $_FILES['lokasi_file']['tmp_name'];

	// cek apakah tidak ada gambar yang diupload
	if( $error === 4 ) {
		echo "<script>
				alert('pilih gambar terlebih dahulu!');
			  </script>";
		return false;
	}

	// cek apakah yang diupload adalah gambar
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
		echo "<script>
				alert('yang anda upload bukan gambar!');
			  </script>";
		return false;
	}

	// cek jika ukurannya terlalu besar
	if( $ukuranFile > 1000000 ) {
		echo "<script>
				alert('ukuran gambar terlalu besar!');
			  </script>";
		return false;
	}

	// lolos pengecekan, gambar siap diupload
	// generate nama gambar baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

	return $namaFileBaru;
}

function ubah($data) {
	global $conn;

	$foto_id = $data["foto_id"];
	$judul_foto = htmlspecialchars($data["judul_foto"]);
	$deskripsi_foto = htmlspecialchars($data["deskripsi_foto"]);

	$query = "UPDATE foto SET
					judul_foto = '$judul_foto', 
					deskripsi_foto = '$deskripsi_foto'
				WHERE foto_id = '$foto_id';
	
        ";

	// var_dump($query); die;
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);	
}
function registrasi($data) {
	global $conn;

	$nama_lengkap = strtolower(stripslashes($data["nama_lengkap"]));
	$username = strtolower(stripslashes($data["username"]));
	$email = strtolower(stripslashes($data["email"]));
	$alamat = strtolower(stripslashes($data["alamat"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);
	
	// cek username sudah ada atau belum
	$result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

	if( mysqli_fetch_assoc($result) ) {
		echo "<script>
				alert('username sudah terdaftar!')
		      </script>";
		return false;
	}


	// cek konfirmasi password
	if( $password !== $password2 ) {
		echo "<script>
				alert('konfirmasi password tidak sesuai!');
		      </script>";
		return false;
	}

	// enkripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);

	// tambahkan userbaru ke database
	mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password', '$email', '$nama_lengkap', '$alamat')");

	return mysqli_affected_rows($conn);

}

function jumlah_like($foto_id){
    global $conn;
    $q = mysqli_query($conn, "SELECT COUNT(*) AS jumlah_like FROM like_foto WHERE foto_id = $foto_id");
    $row = mysqli_fetch_assoc($q);
    return $row['jumlah_like'];
}


?>