<?php
	session_start();
	include('./verification.php');

	if (!$_SESSION['username'] && $_GET['who'] && $_GET['and']){
		$a = $_GET['who'];
		$aa = $_GET['and'];

		if (checkdatauser($a, $aa) == true){
			echo "<script type='text/javascript'>
			alert('Account validated. You can log in.');
			window.location.href = './loginaccount.php';
			</script>";
		}
		else
			header("Location: ../home/index.php");
	}
	else
		header("Location: ./loginaccount.php");

?>
