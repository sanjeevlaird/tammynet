<?php
$PATH = $_POST['Path'];
$logFileName=$_POST['fileName'];
$data =$_POST['data'];

$filename = $PATH.$logFileName.".txt";
$myFile = fopen($filename, 'a') or die("can't open file");
if($myFile)
{
	fwrite($myFile,$data."\n");
}
else
{
	echo "error opening the file";
}
fclose($myFile);
?>