<?php
include "connect.php";

$sql = 'INSERT INTO users(name,email,password) VALUES (:name,:email,:password)';

$stmt = $conn->prepare($sql);
$stmt->bindParam(":name",$uname);
$stmt->bindParam(":email",$uemail);
$stmt->bindParam(":password",$ucrypt_password);


$uname = trim($_POST['name']);
$uemail = trim($_POST['email']);
$upassword = $_POST['password'];
$upassword_c = $_POST['password_confirm'];

$errors =[];

if($uname == ''){
	$errors[] = "No name was provided";
}
if($uemail == ''){
	$errors[] = "No Email was provided";
}
if(trim($upassword) == '' || trim($upassword_c) == ''){
	$errors[] = "Both Password fields need to be filled in";
}
if($upassword !== $upassword_c){
	$errors[] = "Passwords did not match";
}


if(empty($errors)){
	// continue making the user
	$ucrypt_password = password_hash($upassword,PASSWORD_BCRYPT);
	$result = $stmt->execute();
	if($result){
		// $_SESSION["user_name"] = $uname;
		// $_SESSION["user_email"] = $uemail;
		// $_SESSION["user_id"] = $conn->lastInsertId();
		//echo "SUCCESS";
		header( 'Location: http://'.$_SERVER['HTTP_HOST'].$DEBUG__DIR.'/TammyNetHome.php' ) ;
	}
	else {
		echo "FAILED";
	}
}
else
{
	$_SESSION['errors'] = $errors;
	print_r($errors);
	header( 'Location: http://'.$_SERVER['HTTP_HOST'].$DEBUG__DIR.'/TammyNetAdmin.php' ) ;
}