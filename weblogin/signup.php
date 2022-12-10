
<?php 
	require 'functions.php';

	if (isset($_POST["signup"])){
		if ( signup($_POST)>0 ){
			echo "<script> alert('User berhasil ditambahkan') </script>";
		}else{
			echo mysqli_error($conn);
		}
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Daftar Akun</title>
</head>
<body>
	<h1>Daftar akun</h1>
	<form action="" method="post">  
		<ul>
			<li>
				<input type="text" name="newusername" placeholder="Username">
			</li>
			<li>
				<input type="password" name="newpassword" placeholder="Password">
			</li>
			<li>
				<input type="password" name="newpassword2" placeholder="Konfirm password">
			</li>
			<li>
				<button type="submit" name="signup">Daftar</button>
			</li>
		</ul>
	</form>
</body>
</html>