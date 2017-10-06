<!DOCTYPE html>
<html>
<head>
<title>upload story</title></head>
<body>
<?php
session_start();

if (!isset($_SESSION['user_id'])) {
session_destroy();
header("Location: login3.php");
exit;
}
//if($_SESSION['token'] !== $_POST['token']){
	//die("Request forgery detected");
//}
if(isset($_SESSION['user_id'])){
	$stmt = $mysqli->prepare("delete from stories where stories= 'title'?");
        if(!$stmt){
                printf("Query Prep Failed: %s\n", $mysqli->error);
                exit;
        }
        $stmt->bind_param('s', $title);
        $stmt->execute();
        $stmt->close();
		header("Location: home.php");
}
?>
</body>
</html>

