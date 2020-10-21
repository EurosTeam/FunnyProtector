<?php

include 'session.php';
if(isset($_SESSION["passwd"]))
{
	header("Location: obfuscator.php");
}

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>FunnyProtector - Register</title>
</head>
<body>
<center>
	<div id="login">
		FunnyProtector - Register
		<br>
		<br>
		<form action="action.php" method="POST">
			Username:
			<input type="text" name="username">
			<input type="hidden" name="method" value="register">
			<br>
			<br>
			Password:
			<input type="password" name="passwd">
			<br>
			<br>
			Invite Code:
			<input type="text" name="invite">
			<br>
			<br>
			<input type="submit" value="Register !">
		</form>
	</div>
	<br>
	<br>
</center>
</body>
</html>