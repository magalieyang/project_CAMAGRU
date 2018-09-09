<?php
preg_match('/[^\/]*$/', dirname(__FILE__, 4), $nm); //<-- Folder name = database name
include('../config/database.php');

try{
	$connect = new PDO($DB_DSN , $DB_USER, $DB_PASSWORD);
	$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
	echo "Page can't be load. Can't reach the database.";
	exit;
}
?>
