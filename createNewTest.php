<?php
include "connect.php";


$tid = $_POST['tid'];
$name = $_POST['name'];
$product = $_POST['product'];
$mode = $_POST['mode'];
$scripts = $_POST['scripts'];
$uid = $_SESSION['user_id'];

$sql = 'INSERT INTO tests(tammy_id,name,product,mode,user_id) VALUES(:tid,:name,:prod,:mode,:uid)';
$scrSql = 'INSERT INTO test_scripts(test_id,script_id) VALUES(:testid,:scriptid)';

$stmt = $conn->prepare($sql);
$stmt->bindParam(':name',$name);
$stmt->bindParam(':prod',$product);
$stmt->bindParam(':mode',$mode);
$stmt->bindParam(':uid',$uid);
$stmt->bindParam(':tid',$tid);

$scrStmt = $conn->prepare($scrSql);
$scrStmt->bindParam(':testid',$testid);
$scrStmt->bindParam(':scriptid',$scriptid);


// Do validation here
$result = $stmt->execute();
if($result){
	$testid = $conn->lastInsertId();
	foreach ($scripts as $scriptid) {
		$scrStmt->execute();
	}
	echo "success";
	die();
}

echo "Failed\n";
