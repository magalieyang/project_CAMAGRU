<?php
	$name = dirname(__FILE__, 4);
	preg_match('/[^\/]*$/', $name, $nm);

	require_once('./database.php');
	try{
		$connect = new PDO('mysql:host=localhost;port=8081;charset=utf8', $DB_USER, $DB_PASSWORD);
		$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}catch(PDOException $e){
		echo "Page can't be load. Can't install the database ". $nm[0]. ".";
		exit;
	}
	$requete = "CREATE DATABASE IF NOT EXISTS ". $nm[0] ." DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";
	$connect->prepare($requete)->execute();
	include('./setup.php');
	install($nm);
	session_start();
	if ($_SESSION['user'] != NULL){
		$_SESSION['user'] = NULL;
		session_destroy();
	}
	header ('Location: ../home/index.php');

?>
