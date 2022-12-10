<?php 
	session_start();

	if (!isset($_SESSION["login"])){
		header("Location: login.php");
		exit;
	}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
	<div id="header" class="cln-dark" style="width: 91vw;" >
		<h1>Selamat datang, <?= " ",$_COOKIE["nama"]; ?></h1>
	</div>
	<div id="container">
		<a class="logout" href="logout.php"><div class="btn-blue">Logout</div></a>
	</div>
</body> 
</html>