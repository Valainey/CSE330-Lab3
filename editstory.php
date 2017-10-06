<!DOCTYPE html>
<html>
<head>
<title>edit story</title></head>
<body>
<?php

session_start();
require 'database3.php';
if($_SESSION['token'] !== $_POST['token']){
	die("Request forgery detected");
}
$id =$_POST['id'];
$username = $_SESSION['user_id'];
$title =$_POST['title'];
$link = $_POST['link'];

$stmt = $mysqli->prepare("update stories set title=?, link =? where id =?");
        if(!$stmt){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
        }
$stmt->bind_param('ssi', $title, $link, $id);

$stmt->execute();
 
$stmt->close();
header("Location: home.php");
exit;

?>

</body>
</html>
