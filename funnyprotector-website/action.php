<?php
include 'session.php';

$goodregister = "
<!DOCTYPE html>
<html>
<head>
	<link rel='stylesheet' type='text/css' href='style.css'>
	<title>FunnyProtector - Register</title>
</head>
<body>
<center>
	<div id='registered'>
	Succesfully registered, redirecting...
	</div>
</center>
</body>
</html>";

$goodlogin = "
<!DOCTYPE html>
<html>
<head>
	<link rel='stylesheet' type='text/css' href='style.css'>
	<title>FunnyProtector - Login</title>
</head>
<body>
<center>
	<div id='registered'>
	Succesfully logged, redirecting...
	</div>
</center>
</body>
</html>";

$badlogin = "<!DOCTYPE html>
<html>
<head>
	<link rel='stylesheet' type='text/css' href='style.css'>
	<title>FunnyProtector - Login</title>
</head>
<body>
<center>
	<div id='notlogged'>
		The password or the username is incorrect !
	</div>
</center>
</body>
</html>
";

$bannedlogin ="
<!DOCTYPE html>
<html>
<head>
	<link rel='stylesheet' type='text/css' href='style.css'>
	<title>FunnyProtector - Login</title>
</head>
<body>
<center>
	<div id='notlogged'>
		You have been banned.
	</div>
</center>
</body>
</html>
";

$badinvitecode = "
<!DOCTYPE html>
<html>
<head>
	<link rel='stylesheet' type='text/css' href='style.css'>
	<title>FunnyProtector - Login</title>
</head>
<body>
<center>
	<div id='notlogged'>
	Please enter a valid invite code.
	</div>
</center>
</body>
</html>";

$badusername = "
<!DOCTYPE html>
<html>
<head>
	<link rel='stylesheet' type='text/css' href='style.css'>
	<title>FunnyProtector - Login</title>
</head>
<body>
<center>
	<div id='notlogged'>
	This username is already taken.
	</div>
</center>
</body>
</html>";

$db = mysqli_connect("localhost","root","","funnyprotector");
if(!$db)
{
	echo "An error occured !";
}
else
{

	//register mode

	if(!empty($_POST["method"]) AND $_POST["method"] == "register")
	{
		if(!empty(htmlspecialchars($_POST["username"])) and !empty(htmlspecialchars($_POST["passwd"])) and !empty(htmlspecialchars($_POST["invite"])))
		{
			$uid = 0;
			$found = false;
			$dbinvitecode = array(); // creating an array to put fetched invite code
			$username = htmlspecialchars($_POST["username"]); //get the input username
			$password = password_hash(htmlspecialchars($_POST["passwd"]),PASSWORD_DEFAULT); // hashing the input password
			$invitecode = htmlspecialchars($_POST["invite"]); // get the input invite code
			$dbuid = mysqli_query($db,"SELECT `uid` FROM `users` ORDER BY `creationDate` DESC LIMIT 1"); // getting the last uid in the db
			$dbuid = mysqli_fetch_array($dbuid);
			$dbuser = mysqli_query($db,"SELECT `username` FROM `users` WHERE `username` = '".$username."'"); //getting the username for checking if the username is already taken
			$dbuser = mysqli_fetch_array($dbuser);
			$dbinvite = mysqli_query($db,"SELECT `inviteCode` FROM `invitecode` WHERE used = '0'"); //get all invite code in the db for fetching it and checking if the input invite code exist
			while($dbinvitecode = mysqli_fetch_array($dbinvite))
			{
				if(strcmp($dbinvitecode["inviteCode"],$invitecode) == 0) // if the invitecode equal to a db invite code (so the invite it's not fake)
				{
					mysqli_query($db,"UPDATE `invitecode` SET `used` = '1' WHERE `invitecode` = '".$dbinvitecode["inviteCode"]."'"); // set the used variable to true (1) like that nobody will use it anymore
					$found = true;
				}
			}
			if($dbuser == NULL) // if the input username doesn't exist
			{
				if($found == true) // and if the invite code is not fake
				{
					if($dbuid == NULL) // if it's the first to be registered the uid = 1 if not it increment the last uid number in the db
					{
						$uid = 1;
					}
					else
					{
						$uid = $dbuid[0];
						$uid++;
					}

					if(mysqli_query($db,"INSERT INTO `users`(`uid`,`username`, `password`, `banned`, `creationDate`) VALUES ('".$uid."','".$username."','".$password."','0',current_timestamp())") != FALSE) // if the query have no problem show goodregister page and redirect to index.php(login page)
					{
						echo $goodregister;
						//echo $_SERVER['REMOTE_ADDR'];
						header("refresh:2; url=index.php");
					}
				}
				else // if  the invite code was not found show badinvitecode page and redirect to index.php
				{
					echo $badinvitecode;
					header("refresh:2; url=register.php");
				}
			}
			else // and if the username is already taken show badusername page
			{
				echo $badusername;
				header("refresh:2; url=register.php");
			}
		}
	}

	//login mode

	if(!empty($_POST["method"]) AND $_POST["method"] == "login")
	{
		if(!empty(htmlspecialchars($_POST["username"])) and !empty(htmlspecialchars($_POST["passwd"])))
		{
			$user = htmlspecialchars($_POST["username"]); //get the input username
			$pass = htmlspecialchars($_POST["passwd"]); //get the input password
			$dbpass = mysqli_query($db,"SELECT `password` FROM `users` WHERE `username` ='".$user."'"); // get the db pass
			$dbpass = mysqli_fetch_array($dbpass);
			$is_banned = mysqli_query($db,"SELECT `banned` FROM `users` WHERE `username` = '".$user."'"); // get the value of the banned variable to show if he's not banned
			$is_banned = mysqli_fetch_array($is_banned);
			$dbuid = mysqli_query($db,"SELECT `uid` FROM `users` WHERE `username` ='".$user."'"); //get the dbuid
			$dbuid = mysqli_fetch_array($dbuid);
			if(password_verify($pass, $dbpass[0]))  // if the password is good
			{
				if($is_banned[0] == 1) // if banned show bannedpage
				{
					echo $bannedlogin;
				}
				else // if not create a session with is passwd,username and uid and redirect it to obfuscator
				{
					$_SESSION["passwd"] = $dbpass;
					$_SESSION["username"] = $user;
					$_SESSION["uid"] = $dbuid;
					echo $goodlogin;
					header("refresh:2; url=obfuscator.php");
				}
			}
			else // if the password is not good show badlogin and redirect to index.php
			{
				echo $badlogin;
				header("refresh:2; url=index.php");
			}
		}
	}
}

?>