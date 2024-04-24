<?php 
session_start();

if( isset($_SESSION["login"]) ) {
	header("Location: index.php");
	exit;
}

require 'function.php';

if( isset($_POST["login"]) ) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    // cek username
    if( mysqli_num_rows($result) === 1 ) {

        // cek password
        $row = mysqli_fetch_assoc($result);
        if( password_verify($password, $row["password"]) ) {
            // set session
            $_SESSION["login"] = true;
            $_SESSION["user_id"] = $row["user_id"];

            header("Location: index.php");
            exit;
        }
    }

    $error = true;

}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="style.css">
    <title>Login - PixaPort</title>
</head>
<body>
    <div class="bgform">
        <form action="" method="post">
            <div class="titleform">
                <label for="login">Login</label>
            </div>
            <?php if( isset($error) ) : ?>
                <p style="color: red; font-style: italic;">username / password salah</p>
            <?php endif; ?>
            <div class="bginput">
                <input type="text" placeholder="Username" name="username">
                <input type="password" placeholder="Password" name="password">
            </div>
            <div class="bgbutton">
                <button type="submit" name="login">Submit</button>
            </div>
        </form>
        <div class="garisbatas">
            <hr class="hr1">
            <label for="">Atau</label>
            <hr class="hr2">
        </div>
        <div class="bgatau">
            <a href="daftar.php">Daftar</a>
        </div>
    </div>
</body>
</html>