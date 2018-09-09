<?php
require_once("../elements/menunav.php");
include("../elements/footer.html");
include("./verification.php");


	if (!isset($_SESSION['username'])){
		if (isset($_GET['who']) && isset($_GET['and']) && !isset($who)){
			$a = $_GET['who'];
			$aa = $_GET['and'];
			$who = username($aa, $connect);
			$ha = hash('whirlpool',$who['user']);
			if ($who == NULL ||  $ha != $a){
				header("Location: ../home/index.php");
			}
		}
		if ($_SERVER['REQUEST_METHOD'] == 'POST' ){
			if ($_POST['password'] && $_POST['passc'] && $_POST['password'] == $_POST['passc']){
				$pass = hash('whirlpool',$_POST['password']);
				$k = preg_match('/^(?=.*[a-z])(?=.*[0-9])(?=.*[A-Z])([\w\-\.]+)$/', $_POST['password'], $m);
				if (strlen($_POST['password']) >= 6 && $k == 1){
					$req = "UPDATE accountinfos SET password='".$pass."' WHERE username='".$who['username']."'";
					$act = $connect->prepare($req);
					$act->execute();
					echo "<script type='text/javascript'>
					alert('Your new password is now set.');
					window.location.href='./loginaccount.php';
					</script>";
				}
				else{
					echo "<script type='text/javascript'>
					alert('Your requested password is not allowed.');
					window.location.href='./forgetpwdp2.php?who=".$ha ."&and=".$aa."';
					</script>";
				}
			}
			else{
				echo "<script type='text/javascript'>
				alert('New password and the confirmation are not the same or are empty field');
				window.location.href='./forgetpwdp2.php?who=".$ha ."&and=".$aa."';
				</script>";
			}
	}
?>
<html>
	<head>
		<title>CAMAGRU</title>
		<link rel="stylesheet" href="../../css/index.css">
		<link rel="stylesheet" href="../../css/account.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script type="text/javascript" src="../../js/menunav.js"></script>
		<meta charset="UTF-8">
	</head>

<body>
	<div class="dataarea">
		<table>
		<tr><th>RESET PASSWORD : <?php if (isset($who)) { echo $who['user']; } ?></th>
		</tr>
		<tr>
		<td>
		<div class="personnalinfos">
		<form action="" method="post" name="formulaire" autoComplete="off">
			<p>NEW PASSWORD: <input name="password" value="" type="password" autoComplete="off" class="efi"></p>
			<p>CONFIRMATION PASSWORD: <input name="passc" value="" type="password" autoComplete="recover_email" class="efi"></p>
			<input type="submit" name="SUBMIT">
		</form></div></td></tr></table>
</div>

</body></html>

<?php
}
else
	header("Location: ../home/index.php");
?>
