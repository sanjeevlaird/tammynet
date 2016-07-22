<?php 
include "connect.php";
$id = $_GET["id"];

$cols = [
	"tests.name as test_name",
	"tests.product",
	"tests.mode",
	"users.name as user_name",
	"users.email as user_email",
	"tammysetup.tammyname",
	"tammysetup.tammyip",
	"scriptidini.id as script_id",
	"scriptidini.filename as script_filename",
	"scriptidini.scriptname as script_name",
	"scriptidini.description as script_desc"
];

$sql = "SELECT ".join(',',$cols)."
FROM tests 
LEFT JOIN users 
ON tests.user_id = users.id 
JOIN tammysetup 
ON tammysetup.tammyid = tests.tammy_id 
LEFT JOIN test_scripts 
ON test_scripts.test_id = tests.id
LEFT JOIN scriptidini	
ON scriptidini.id = test_scripts.script_id
WHERE tests.id = :id AND
users.id = :uid AND tests.removed_at IS NULL ";


$stmt = $conn->prepare($sql);
$stmt->bindParam(':id',$_GET['id']);
$stmt->bindParam(':uid',$_SESSION['user_id']);
if(!$stmt->execute())	
{ die("Failed to grab user data");}
$stmt->setFetchMode(PDO::FETCH_ASSOC);



function grab_scripts($obj){
	$arr = [];
	foreach ($obj as $key => $value) {
		if(preg_match("/^script_/",$key)){
			if($value == null){return $arr;}
			$newKey = preg_replace("/script_/","",$key);
			$arr[$newKey] = $value;
		}
	}
	return $arr;
}
$scripts = $stmt->fetchAll();
if(empty($scripts)){
	die("{}");
}
$tests = $scripts[0];
$scripts = array_map(grab_scripts,$scripts);
if(empty($scripts[0])){
	$scripts = [];
}

foreach ($tests as $key => $value) {

	if(preg_match("/^script/",$key))
	{
		unset($tests[$key]);
	}
}

$tests["scripts"] = $scripts;

echo json_encode($tests);