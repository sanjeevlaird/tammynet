<?php
$PATH = $_POST['Path'];
$logFileName=$_POST['fileName'];

$filename = $PATH.$logFileName.".txt";
$myFile = fopen($filename, 'w') or die("can't open file");
fclose($myFile);
?>