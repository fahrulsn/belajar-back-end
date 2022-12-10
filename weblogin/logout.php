<?php 
	session_start();
	session_unset();
	$_SESSION = [];
	session_destroy();

	setcookie('id','', time()-60);
	setcookie('key','', time()-60);
	setcookie('nama','', time()-60);

	header("Location: login.php");
	exit;
 ?>