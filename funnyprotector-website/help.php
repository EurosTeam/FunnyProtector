<?php

include 'session.php';
if(!isset($_SESSION["passwd"]))
	{
		header("Location: index.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>FunnyProtector - Help</title>
</head>
<body>
<div id="protectionguide">
	Welcome to this protection guide reserved to subscribers.
	<br>
	<br>
	1. How to avoid cracking.
	- The best solution to avoid cracking it's to convert your python script to exe file.
	<br>
	- You can use pyinstaller,cxfreeze,etc.
	<br>
	2. 
</div>
</body>
</html>