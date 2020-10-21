<?php
include 'session.php';

$userpanel = "
<!DOCTYPE html>
<html>
<head>
	<link rel='stylesheet' type='text/css' href='style.css'>
	<title>FunnyProtector - Obfuscator Dashboard</title>
</head>
<body>
<center>
<br>
<br>
<div id='dashboard'>
	Welcome to FunnyProtector !
	<br>
	<br>
	You can download FunnyProtector <a href='download.php'>here</a>.
</div>
<br>
<div id='howto'>
	If you don't know how to use it, here is a little tutorial on how to use it
	<br>
	<br>
	<iframe src='http://www.youtube.com/embed/ff-i7O8kI4I' width='360' height='180' frameborder='0'></iframe>
	<br>
	<br>
	<div id='tips'>
		Want's more protection ? Check this <a href='help.php'>Protection Tips</a>.
	</div>
	<br>
	<br>
	<a href='logout.php'>Logout</a>
</div>
</center>
</body>
</html>";

$adminpanel = "
<!DOCTYPE html>
<html>
<head>
	<link rel='stylesheet' type='text/css' href='style.css'>
	<title>FunnyProtector - Obfuscator Dashboard</title>
</head>
<body>
<center>
<br>
<br>
<div id='dashboard'>
	Welcome admin.
	<br>
	<br>
	You can download FunnyProtector <a href='download.php'>here</a>.
</div>
<br>
<div id='howto'>
	If you don't know how to use it, here is a little tutorial on how to use it
	<br>
	<br>
	<iframe src='http://www.youtube.com/embed/ngqss8Diddd' width='360' height='180' frameborder='0'></iframe>
	<br>
	<br>
	<div id='tips'>
		Want's more protection ? Check this <a href='help.php'>Protection Tips</a>.
	</div>
	<br>
	<br>
	<a href='logout.php'>Logout</a>
	<a href='adminpanel.php'>Panel</a>
</div>
</center>
</body>
</html>";

if(!isset($_SESSION["passwd"]))
{
	header("Location: index.php");
}
else
{
	if($_SESSION["username"] == "sanity")
	{
		echo $adminpanel;
	}
	else
	{
		echo $userpanel;
	}
}
?>