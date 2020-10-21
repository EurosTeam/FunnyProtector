<?php
include 'session.php';
$db = mysqli_connect("localhost","root","","funnyprotector");
if(isset($_SESSION["username"]))
{
	if($_SESSION["username"] != "sanity")
	{
		header("Location: index.php");
	}
	else
	{
		if(isset($_POST["usertoban"]))
		{
			mysqli_query($db,"UPDATE `users` SET `banned` = '1' WHERE `username` = '".htmlspecialchars($_POST["usertoban"])."'");
		}
		if(isset($_POST["invitetoadd"]))
		{
			mysqli_query($db,"INSERT INTO `invitecode`(`inviteCode`,`used`) VALUES ('".htmlspecialchars($_POST["invitetoadd"])."','0');");
		}
	}
}
else
{
	header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="adminstyle.css">
	<title>FunnyProtector - Admin Panel</title>
</head>
<body>
	<center>
<div id="panel">
	<form action="adminpanel.php" method="POST">
	Ban user
	<br>
	<input type="text" name="usertoban">
	<input type="submit" value="Ban !">
	<br>
	<br>
	Add Invite Code
	<br>
	<input type="text" name="invitetoadd">
	<input type="submit" value="Add it !">
	</form>
</div>
</center>
</body>
</html>