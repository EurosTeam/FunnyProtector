<?php
include 'session.php';
if(isset($_SESSION["passwd"])) //if the user is connected
{
	header("Location: obfuscator.php");
}
?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>FunnyProtector - Login</title>
</head>
<body>
<center>
	<div id="login">
		FunnyProtector - Login
		<br>
		<br>
		<form action="action.php" method="POST">
			Username:
			<input type="text" name="username">
			<input type="hidden" name="method" value="login">
			<br>
			<br>
			Password:
			<input type="password" name="passwd">
			<br>
			<br>
			<input type="submit" value="Login !">
		</form>
	</div>
	<br>
	<br>
<div id="register">
	Didn't Register yet? <a href="register.php">Register Now !</a>
</div>
</center>
</body>
</html>