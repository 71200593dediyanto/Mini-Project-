
<?php
session_start();
$servername = "127.0.0.1";
$username = "root";
$password = "";
$databasename = "gofit";
$conn = mysqli_connect($servername, $username, $password, $databasename) or die("Koneksi gagal.");

$errMssg = "";


?>

<?php

if(isset($_POST["login"])){

	$username = $_POST["username"];
	$selectAdmin = "SELECT * FROM `admin` WHERE username = '$username'";
	$result = mysqli_query($conn,$selectAdmin);

	if(mysqli_num_rows($result) === 1){
		$row = mysqli_fetch_array($result);
		if($row["password"] === $_POST["password"]){
			$_SESSION["login"] = true;
			$_SESSION["nama"] = $row["nama"];
			$_SESSION["idAdmin"] = $row["idAdmin"];
			header('Location:index.php' );
			$errMssg = "";
			exit;
		}else{
			$errMssg = "Maaf, Username atau Password Anda Salah !!"; 
		}
	}else{
		$errMssg = "Maaf, Username Anda Tidak Terdaftar Di Database"; 
	}

}

?>

<!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="UTF-8">
	<title>Login Page GoFit</title>
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/all.css'>
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css'>
    <link rel="stylesheet" href="css/login.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/tombol.css?v=<?php echo time(); ?>">
	<link rel="shortcut icon" href="logo/Logo2.png" type="image/x-icon">

</head>
<body>
<div class="container">
	<div class="screen">
		<div class="screen__content">
			<form action="" method="POST" name="formLogin" enctype="multipart/form-data" class="login" >
				<div class="login__field">
					<i class="login__icon fas fa-user"></i>
					<input name="username" type="text" class="login__input" id="usernamedAdmin" placeholder="Masukkan Username" required>
				</div>
				<div class="login__field">
					<i class="login__icon fas fa-lock"></i>
					<input name="password" type="password" class="login__input" id="passwordAdmin" placeholder="Password" required>
				</div>

				<div id="errorAlert">
					<p style="color:red;font-weight: bold;font-size: 14px;"> <?php echo $errMssg; ?></p>
				</div>

				<button id = "loginbttn" type="submit" name="login" class="button login__submit" > 
					<span class="button__text">Log In Now</span>
					<i class="button__icon fas fa-chevron-right"></i>
				</button>				
			</form>
			<div class="social-login">
				<h3>Want To Join Our Team ?</h3>
				<div class="social-icons">
					<a href="#" class="social-login__icon fab fa-instagram"></a>
					<a href="#" class="social-login__icon fab fa-facebook"></a>
					<a href="#" class="social-login__icon fab fa-google"></a>
				</div>
			</div>
		</div>
		<div class="screen__background">
			<span class="screen__background__shape screen__background__shape4"></span>
			<span class="screen__background__shape screen__background__shape3"></span>		
			<span class="screen__background__shape screen__background__shape2"></span>
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>		
	</div>
</div>
</body>
</html>



