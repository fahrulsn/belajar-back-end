<?php 
	$conn = mysqli_connect("localhost","root","","weblogin");

	// function query($query){
	// 	global $conn;
	// 	$result  = mysqli_query($conn,$query);

	// 	$rows = [];
	// 	while ($row = mysqli_fetch_assoc($result)){
	// 		$rows[]=$row;
	// 	}
	// 	return $rows;
	// }

	function signup($data){
		global $conn;
		//menangkap data dari _post
		$nama = mysqli_real_escape_string($conn, $data["newnama"]);
		$username = strtolower(stripcslashes($data["newusername"]));
		$password = mysqli_real_escape_string($conn, $data["newpassword"]);
		$password2 = mysqli_real_escape_string($conn, $data["newpassword2"]);
		//cek username jika kosong
		if( $username === ""){
			echo "<script> alert('Silakan isi username') </script>";
			return false;
		}
		// cek password jika kosong
		if ( $password === ""){
			echo "<script> alert('Silakan isi password') </script>";
			return false;
		}
		//cek duplikasi username
		$result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
		if (mysqli_fetch_assoc($result)){
			echo "<script> alert('Username sudah terdaftar') </script>";
			return false;
		}
		//cek konfirmasi password
		if ( $password !== $password2){
			echo "<script> alert('Konfirmasi password tidak sesuai') </script>";
			return false;
		}
		//enkripsi password
		$password = password_hash($password, PASSWORD_DEFAULT);
		//tambah user ke databse
		mysqli_query($conn, "INSERT INTO users VALUES('','$nama', '$username', '$password')");
		//retur nilai 1 jika berhasil -1 jika gagal
		return mysqli_affected_rows($conn);
	}
 ?>