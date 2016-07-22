<?php
include "connect.php";

if(!isset($_POST['_method']) || $_POST['_method'] != "DELETE"){
	die('{"success" : false}');
}

$sql = "UPDATE tests SET removed_at = NOW() WHERE tests.id = :tid AND tests.user_id = :uid";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':uid',$uid);
$stmt->bindParam(':tid',$tid);

$uid = $_SESSION['user_id'];
$tid = $_POST['id'];

$result = $stmt->execute();

if(!$result){
	die('{"success" : false}');
}
else
{
	die('{"success" : true}');
}