<!DOCTYPE html>
<html>
<head>
<title>upload story</title></head>
<body>
<?php
session_start();
require 'database3.php';

if (!isset($_SESSION['user_id'])) {
session_destroy();
header("Location: login3.php");
exit;
}
if($_SESSION['token'] !== $_POST['token']){
	die("Request forgery detected");
}
if(isset($_SESSION['user_id'])){
$username = $_SESSION['user_id'];
$title =$_POST['title'];
$link = $_POST['link'];
$content =$_POST['content'];
$stmt = $mysqli->prepare("insert into stories (username, title, link, content) values (?, ?, ?, ?)");
if(!$stmt){
	printf("Query Prep Failed: %s\n", $mysqli->error);
	exit;
}
 
$stmt->bind_param('ssss', $username, $title, $link, $content);
 
$stmt->execute();
 
$stmt->close();
header("Location: home.php");
}
?>


</body>
</html>


 

