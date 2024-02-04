<?php

$UserName = $_POST['user_name'];
$UserPwd = $_POST['user_pwd'];

$host = "localhost";
$username = "root";
$password = "";
$dbname = "PRICEWIZ";
$link =mysqli_connect($host, $username, $password, $dbname);
if ($link->connect_error)
{
	die("Connection failed: " . $link->connect_error);
}
else
{
	$queryCheck = "select * from USER where user_name= '".$UserName."'";
	$resultCheck = $link->query($queryCheck);
	if($resultCheck->num_rows == 0)
	{
		echo " User ID does not exist";
	}
	else
	{
		$row = $resultCheck->fetch_assoc();
		if($row["user_pwd"] == $UserPwd)
		{
			session_start();
			$_SESSION["user_ID"] = $UserID;

			header("Location:\PRICEWIZ\Admin_page\home_page.php");
		}
		else
		{
			echo"Wrong Password!<br><br>";
			echo"Click <a href='admin_login_page.html'> HERE </a> to login again";
		}
	}
}
mysqli_close($link);
?>