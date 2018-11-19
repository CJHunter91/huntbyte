<?php
$file = $_GET['saveTo'];
$contents = $_POST['contents'];
// Write the contents to the file, 
$fp = fopen($file, 'w');
fwrite($fp, $contents);
fclose($fp);
$redirect = basename($file,'.html');
//redirect
header('location: http://www.huntbyte.com/'. $redirect . '.php');
?>