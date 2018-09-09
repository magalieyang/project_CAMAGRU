<?php
session_start();
include("./verification.php");

echo $_POST['user'];

if (!$_SESSION['username'])
{
	if (($who = login()) != 0 ){
		if ($who['groupe'] == 'on'){
		$_SESSION['user'] = $who['user'];
		$_SESSION['mail'] = $who['mail'];
		$_SESSION['password'] = $who['password'];
		$_SESSION['date_inscription'] = $who['date_inscription'];
		$_SESSION['username'] = $who['username'];
		$_SESSION['notif'] = $who['notif'];
		header ('Location: ../home/index.php');
		}
		else{
			echo "<script type='text/javascript'>
			alert('You need to validate your account. Please check your mails.');
			window.location.href='./loginaccount.php';
			</script>";
		}
	}
	else{
		echo "<script type='text/javascript'>
		alert('Some informations are wrong.');
		window.location.href='./loginaccount.php';
		</script>";
	}
}
else
	header ('Location: ../home/index.php');

?>
