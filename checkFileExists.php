<?php
$PATH = $_POST['Path'];
$logFileName=$_POST['fileName'];

$filename = $PATH.$logFileName.".txt";

if (file_exists($filename)) {
    echo "The file $filename exists";
} else {
    echo "The file $filename does not exist";
}
?>