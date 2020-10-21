<?php

$db = mysqli_connect("localhost","root","","funnyprotector");
$secretkey = "c7Cf8654UrhLPD4ikQ2zd5q3tHE9P53mZn7zXH4L";
if(!$db)
{
	echo "An error occured !";
}
else
{
	if(!empty(htmlspecialchars($_GET["username"])) and !empty(htmlspecialchars($_GET["passwd"])))
		{
			$user = htmlspecialchars($_GET["username"]);
			$pass = htmlspecialchars($_GET["passwd"]);
			$dbpass = mysqli_query($db,"SELECT `password` FROM `users` WHERE `username` ='".$user."'");
			$dbpass = mysqli_fetch_array($dbpass);
			$is_banned = mysqli_query($db,"SELECT `banned` FROM `users` WHERE `username` = '".$user."'");
			$is_banned = mysqli_fetch_array($is_banned);
			if(password_verify($pass, $dbpass[0]))
			{
				if($is_banned[0] == 1)
				{
					echo "{\"status\":\"banned\"}";
				}
				else
				{
					$date = gmdate("Y-m-d H:i");
					echo "{\"status\":\"success\",\"hash\":\"".hash('sha256',$user.$secretkey.$date.$pass)."\"}";
				}
			}
			else
			{
				echo "{\"status\":\"error\"}";
			}
		}
}

?>