<?php
	session_start();
	$uname = $_POST['username'];
	$password = password_hash($_POST['password'], PASSWORD_BCRYPT);//safer hashing for passwords
	$ActiveUser = '';
	include_once('config.php');
	$sql = "select username from users where username=:username and password=:password";
	$stmt = $conn1->prepare($sql);
	$stmt->bindParam(':username',$uname);
	$stmt->bindParam(':password',$password);
	$stmt->execute();
	while($rows = $stmt->fetch(PDO::FETCH_NUM)){
		$ActiveUser = $rows[0];
	}
	if(!empty($ActiveUser)){
		$_SESSION['user'] = $ActiveUser;
	}
	header("Location: /xvwa/");
	
?>
