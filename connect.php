<?php 
	session_start();
	$servername = "localhost";
	$username = "root";
	$password = "Laird@123";
	$dbname= "laird";
	$DEBUG__DIR = '';

	// // Create connection
	error_reporting(0);
	@ini_set('display_errors', 0);
	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
		$conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
