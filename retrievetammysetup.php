<?php
$servername = "localhost";
$username = "root";
$password = "Laird@123";
$dbname= "laird";

// Create connection
error_reporting(0);
@ini_set('display_errors', 0);
$conn = new mysqli($servername, $username, $password,$dbname);

$tammyid =$_POST['tammyid'];

if($tammyid){
$tammyid = mysqli_real_escape_string($conn,$tammyid);

// Matching user input email and password with stored email and password in database.
$sql="SELECT SQL_CACHE tammyid,tammyname,tammyip,productbitmask FROM tammysetup WHERE tammyid=".$tammyid;
$result = $conn-> query($sql);
$row = $result->fetch_assoc();

echo $row["tammyid"]."=[".$row["tammyname"]."][".$row["tammyip"]."][".$row["productbitmask"]."]";

}

else {
	$sql="SELECT * FROM tammysetup";
	$result = $conn-> query($sql);
	$rows = $result->fetch_all(MYSQLI_ASSOC);
	echo json_encode($rows);
}
mysqli_close($conn); // Connection Closed.
?>
