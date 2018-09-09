<?php
session_start();
require_once('../config/catch_pdo.php');

function supprit($connect, $img, $where, $what){
	$suppr = "DELETE FROM $where
				WHERE $what= ". $img .";";
	$dosuppr = $connect->prepare($suppr);
	$dosuppr->execute();
}

if (isset($_SESSION['username'])&& isset($_POST['subsuppr']))
{
	$img = $_POST['subsuppr'];

	if ($connect){
		$exists = "SELECT accountinfos.username,
							accountinfos.id,
							gallery.idpic,
							gallery.iduser
							FROM accountinfos
							LEFT JOIN gallery
							ON gallery.iduser = accountinfos.id
							WHERE gallery.idpic = ".$img.";";
		$doexists = $connect->prepare($exists);
		$doexists->execute();
		$check  = $doexists->fetch();

		if ($check['username'] != $_SESSION['username']){
			echo "<script type='text/javascript'>
			alert('An error has occurred, try it later...');
			window.location.href  = '../home/index.php';
			</script>";

		}else{
			supprit($connect, $img, 'like_photos', 'like_photos.idpost');
			supprit($connect, $img, 'comm', 'comm.idpost');
			supprit($connect, $img, 'gallery', 'gallery.idpic');
		}
	}
		header('Location: ' . $_SERVER['HTTP_REFERER']);

}else{
	header('Location: ../account/loginaccount.php');
}
?>
