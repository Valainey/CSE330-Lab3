<!DOCTYPE html>
<html>
<head>
<title>login</title>
<style>
		body{
			background-color: linen;
			text-align: center;
		}

	h1{
			color: maroon;
			margin-left: auto;
		}
</style>
</head>
<body>
<form name = "LOGIN" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
username: <input type = "text" name = "username"><br>
password: <input type="password" name="password"><br>
<input type="submit" name = "login" value= "login"><br>
</form>
<form name = "register" action="register3.php" method="POST">
	<input type="submit" name="register" value="register"><br>
</form>
<?php
session_start();
require 'database3.php';
// Use a prepared statement
if(isset($_POST['username']) && isset($_POST['password'])){

	$stmt = $mysqli->prepare("SELECT COUNT(*), id, password FROM users WHERE username=?");

	// Bind the parameter
	$username = $_POST['username'];

	$stmt->bind_param('s', $username);
	$stmt->execute();
	 
	// Bind the results
	$stmt->bind_result($cnt, $user_id, $pwd_hash); 
	$stmt->fetch();
	 
	$pwd_guess = $_POST['password'];
	// Compare the submitted password to the actual password hash
	if( $cnt == 1 && crypt($pwd_guess, $pwd_hash)==$pwd_hash){
			// Login succeeded!
			$_SESSION['user_id'] = $username;
			header('Location: home.php');
			exit;
	}
	else{
		echo "Password incorrect. Please try again.";

	}
}
?>
</body>
</html>