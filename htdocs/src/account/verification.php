<?php
function login(){
	$usr = $_POST['user'];
	$pwd = hash('whirlpool', $_POST['password']);

	require_once('../config/catch_pdo.php');
	if ($connect){
		$requete = "SELECT * FROM accountinfos WHERE user LIKE '".$usr."'";
		$act = $connect->prepare($requete);
		$act->execute();
		$res = $act->fetch(PDO::FETCH_ASSOC);
		if ($res != NULL){
			$requete = "SELECT password FROM accountinfos WHERE user LIKE '".$usr."'";
			$act = $connect->prepare($requete);
			$act->execute();
			$res2 = $act->fetch(PDO::FETCH_ASSOC);
			if ($res2['password'] == $pwd){
				return($res);
				}
			}
		}
	return(0);
}

function create(){
	$usr = htmlspecialchars(addslashes($_POST['user']), ENT_QUOTES | ENT_HTML5);
	$password = hash('whirlpool', $_POST['password']);
	$mail = $_POST['mail'];

	require_once('./config/catch_pdo.php');
	if ($connect){
		$requete = "SELECT user FROM accountinfos WHERE user LIKE '".$usr."'";
		$act = $connect->prepare($requete);
		$act->execute();
		$res = $act->fetch(PDO::FETCH_ASSOC);
		if ($res)
			return(0);
		else{
			$username = md5(uniqid(rand(), true));
			$requete = "INSERT INTO accountinfos (user, password, groupe, mail, date_inscription, username, avatar)
						VALUES ('".$usr."','".$password."','off','".$mail."', CURRENT_DATE, '". $username."', '../../other/member.png')";
			$act = $connect->prepare($requete);
			$act->execute();
			if (!file_exists("../../photos/".$username)){
				mkdir("../../photos/".$username);
			}
			$requete = "SELECT * FROM accountinfos WHERE user LIKE '".$usr."'";
			$act = $connect->prepare($requete);
			$act->execute();
			$res = $act->fetch(PDO::FETCH_ASSOC);
			return($res);
		}
	}
	return(0);
}

function username($username, $connect){

		$requete = "SELECT * FROM accountinfos WHERE username='".$username."'";
		$act = $connect->prepare($requete);
		$act->execute();
		$res = $act->fetch(PDO::FETCH_ASSOC);
		if ($res != NULL){
			return($res);
		}
		return(NULL);
}

function checkdatauser($name, $nickname){

	require_once('../config/catch_pdo.php');

	if ($connect){
		$req = 'SELECT username, user, groupe FROM `accountinfos` WHERE username="'. $nickname . '" AND user="'. $name .'";';
		$act = $connect->prepare($req);
		$act->execute();
		$res = $act->fetch(PDO::FETCH_ASSOC);
		if ($res){
			if ($res['groupe'] == 'off'){
				$req = 'UPDATE accountinfos SET groupe="on" WHERE username="'. $nickname .'";';
				$act = $connect->prepare($req);
				$act->execute();
				return(true);
			}
		}
		return(false);
	}
}
?>
