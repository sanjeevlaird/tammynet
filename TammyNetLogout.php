<?php 
	include "connect.php";

	unset($_SESSION['user_name']);
	unset($_SESSION['user_id']);
	unset($_SESSION['user_email']);

	header('Location: http://'.$_SERVER['HTTP_HOST'].$DEBUG__DIR.'/TammyNetLogin.html');
?>