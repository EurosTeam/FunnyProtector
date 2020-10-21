<?php
include 'session.php';
if(!isset($_SESSION["passwd"])) // if the user is not connected
{
	header("Location: index.php");
}
$file_url = 'http://www.myremoteserver.com/DDJDFJBFDJG/NJGDJNKGFKJ/FunnyProtector.rar';
header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary");
header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");
readfile("DDJDFJBFDJG/NJGDJNKGFKJ/FunnyProtector.rar");
?>