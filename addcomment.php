<!DOCTYPE html>
<html>
<head><title> Comment add </title></head>
<body>

<?php
session_start();

if($_SESSION['token'] !== $_POST['token']){
	die("Request forgery detected");
}
if (!isset($_SESSION['user_id'])) {
session_destroy();
header("Location: login3.php");
exit;
}

if(isset($_SESSION['user_id'])){				
require 'database3.php';
$username = $_SESSION['user_id'];
$title =$_POST['title'];
$content =$_POST['content'];
$stmt = $mysqli->prepare("insert into message (username, title, content) values (?, ?, ?)");
$stmt->bind_param('sss', $username, $title, $content);
 
$stmt->execute();
 
$stmt->close();
header("Location: home.php");
}
?>
</body>
</html>

