<?php
require 'database3.php';

if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirmpassword'])){
	$username = $_POST['username'];
    $password = crypt($_POST['password']);
	//to prevent mysql injection
	$username= mysql_real_escape_string($username);
	$password= mysql_real_escape_string($password);
	$stmt = $mysqli->prepare("insert into users (username, password) values (?, ?)");
	if(!$stmt)
	{
		printf("Query Prep Failed: %s\n", $mysqli->error);
		echo "The usename has  already taken!";
		exit;
	}
	//echo $password;
	header("Location: login3.php");
}

else{
	header("Location: register3.php");
	exit;
}

if(isset($_POST['invalid'])){
echo "username already exists";
}




 
$stmt->bind_param('ss', $username, $password);
 
$stmt->execute();
 
$stmt->close();
session_start();
$_SESSION['user_id'] = $username;
$_SESSION['token'] = substr(md5(rand()), 0, 10);


?>