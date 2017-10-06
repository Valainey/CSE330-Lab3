<?php

$mysqli = new mysqli('localhost', 'root', '971028yyn', 'testdb');

if($mysqli-> connect_errno) {
	printf("Connection Failed: %s\n", $mysqli->connect_error);
	exit;
}
?>