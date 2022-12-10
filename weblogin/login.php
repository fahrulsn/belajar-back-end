<?php 
	session_start();

	require 'functions.php';
	// cek cookie
	if ( isset($_COOKIE['id']) && isset($_COOKIE['key']) ){
		//ambil data
		$id = $_COOKIE['id'];
		$key = $_COOKIE['key'];
		// ambil username sesuai id
		$result = mysqli_query($conn, "SELECT username FROM users WHERE id = $id");
		//convert to array assoc
		$row = mysqli_fetch_assoc($result);
		// cek username dengan key username
		if( $key === hash('sha256',$row["username"])){
			$_SESSION["login"] = true; 
		}

	}
	//jika sudah login dialihkan ke index
	if ( isset($_SESSION["login"]) ) {
		header("Location: index.php");
		exit;
	}
	//cek tombol submit 
	if ( isset($_POST["submit"]) ){		
		//ambil data 
		$username = $_POST["username"];
		$password = $_POST["password"];

		// cek username 
		$result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
		// cek password
		if (mysqli_num_rows($result) === 1){
			$row = mysqli_fetch_assoc($result);
			if(password_verify($password, $row["password"])){

				$_SESSION["login"] = true;
				// $_SESSION["username"] = $_POST["username"];
				setcookie('nama',$username,time()+(365*24*60*60));
				//cek remember
				if ( isset($_POST["remember"]) ){
					//set cookie
					setcookie('id',$row["id"],time()+60);
					setcookie('key',hash('sha256', $row["username"]),time()+60);
				}

				header("Location: index.php");
				exit;
			}	
		}
		// jika salah keluar error
		$error = true;
	}
	if (isset($_POST["signup"])){
		if ( signup($_POST)>0 ){
			echo "<script> alert('User berhasil ditambahkan') </script>";
		}else{
			echo mysqli_error($conn);
		}
	}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
	<div class="blacklayer">
		<div class="cln-dark signup">
			<h3 class="closesignup">X</h3>
			<h1 style="text-align: center;">Daftar Akun</h1>
			<form action="" method="post">
				<label for="newusername">Masukkan username</label>
				<input type="text" name="newusername" id="newusername">

				<label for="newpassword">Masukkan password</label>
				<input type="password" name="newpassword" id="newpassword">

				<label for="newpassword2">Masukkan konfirmasi password</label>
				<input type="password" name="newpassword2" id="newpassword2">

				<button type="submit" style="width:100%;margin-top:7%" name="signup" class="btn-blue"><h3>Daftar</h3></button>
			</form>
		</div>
	</div>
	
	<div id="header" class="cln-dark"><h1>MyLogo</h1></div>
	<div id="container">
		<div id="loginbox">			
			<div id="userpass" class="cln-dark">
				<h1>Login</h1>
				<form action="" method="post">
					<input type="text" name="username" id="username" placeholder="Masukkan Username">
					<input type="password" name="password" id="password" placeholder="Masukkan Password"> 
					<?php if (isset($error)): ?>
						<div class="alert">
							<p class="alert">Username / Password salah</p>
						</div>
					<?php endif; ?>
					<div class="remember">
						<input style="height: 15px;width:15px;margin: 0 4px;padding: 0;" type="checkbox" name="remember" id="remember">
						<label for="remember">Remember me</label>
					</div>
				
			</div>
			<button type="submit" name="submit" class="btn-blue"><h3>Login</h3></button>
				</form>
			<p class="cln-dark" style="padding: 10px 20px">Belum punya akun? <button onclick="signup()" class="btn-white">Daftar</button></p>
		</div>
	</div>
</body> 
<script>
	const blacklayer = document.querySelector('.blacklayer');
	const closesignup = document.querySelector('.closesignup');
	const loginbox = document.querySelector('#loginbox');
	const header = document.querySelector('#header');

	function signup(){
		blacklayer.style.display = "flex";
		loginbox.style.display = "none";
		header.style.display = "none";
	}

	closesignup.addEventListener("click",function(){
		blacklayer.style.display = "none";
		loginbox.style.display = "flex";
		header.style.display = "block";
	})
</script>
</html>