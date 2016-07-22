<?php

	error_reporting(0);
	@ini_set('display_errors', 0);
$PATH = $_POST['Path'];
$logFileName=$_POST['fileName'];

$filename = $PATH.$logFileName.".txt";
$myFile = fopen($filename, 'r') or die("can't open file");
if ($myFile)
{
	while (($line = fgets($myFile)) !=false) 
	{
		echo "[".$line."]";
	}
}
else
{
	echo "error opening the file";
}
fclose($myFile);
?>