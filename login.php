<?php
include "connect.php";

	$sql = "SELECT * FROM users WHERE users.email = :email";

	$stmt = $conn->prepare($sql);
	$stmt->bindParam(":email",$email);


	$email = $_POST['email'];
	$password = $_POST['password'];

	if(!$stmt->execute()){
		die("Error when trying to log in");
	}

	$stmt->setFetchMode(PDO::FETCH_ASSOC);

	$row = $stmt->fetch();
	if($row && password_verify($password,$row['password'])){
		$_SESSION["user_name"] = $row['name'];
		$_SESSION["user_id"] = $row['id'];
		$_SESSION["user_email"] = $row['email'];
		header( 'Location: http://'.$_SERVER['HTTP_HOST'].$DEBUG__DIR.'/TammyNetHome.php' );
	}
	else
	{
		die("Wrong username or password");
	}


?>