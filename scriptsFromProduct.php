<?php
include "connect.php";

$productname =$_GET['product'];

if($productname){

	// Matching user input email and password with stored email and password in database.
	$sql='SELECT scriptidini.id,scriptidini.scriptname,scriptidini.productbitmask,scriptidini.prioritylevel FROM scriptidini,products WHERE products.productname = :productname AND products.productbitvalue & scriptidini.productbitmask <> 0';
	$stmt = $conn->prepare($sql);
	$stmt->bindParam(":productname",$productname);
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$result = $stmt->execute();
	if($result){
		$row = $stmt->fetchAll();
		echo json_encode($row);
	}
}
else {
	$sql="SELECT * FROM scriptidini";
	$stmt = $conn->prepare($sql);
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$result = $stmt->execute();
	if($result){
		$row = $stmt->fetchAll();
		echo json_encode($row);
	}
}

$conn = null;
die();
?>

