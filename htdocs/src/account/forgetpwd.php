<?php
	require_once("../elements/menunav.php");
	include("../elements/footer.html");

	if (!isset($_SESSION['username'])){
		if ($_SERVER['REQUEST_METHOD'] == 'POST' ){
			$connect = new PDO($DB_DSN , $DB_USER, $DB_PASSWORD);
			if ($connect){
				$srch = $_POST['mail'];
				$req = "SELECT user, mail, username FROM accountinfos WHERE mail='" . $srch ."';";
				$do = $connect->prepare($req);
				$do->execute();
				$res = $do->fetch();
				if ($res){
					$ha = hash('whirlpool',$res['user']);
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

					mail($res['mail'], "Reset your password.",
					"
					<html><body>
					Hello! ".$res['user']."<br />
					<br />
					You can reset your password right here:
					<a href='http://localhost:8081/camagru/forgetpwdp2.php?who=".$ha."&and=" . $res['username']. "' alt='link'>here</a>
					</body></html>",
					$headers);

					echo "<script type='text/javascript'>
					alert('Your request has been send. Please check your email.');
					window.location.href='../home/index.php';
					</script>";
				}else{
					echo "<script type='text/javascript'>
					alert('No account found with this email.');
					window.location.href='../home/index.php';
					</script>";
				}
			}
		}
	}else{
		header("Location: ../home/index.php");
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
		<tr><th>RECOVER PASSWORD</th>
		</tr>
		<tr>
		<td>
		<div class="personnalinfos">
		<form action="#" method="post" name="formulaire" autoComplete="off">
			<p>EMAIL: <input name="mail" value="" type="email" autoComplete="recover_email" class="efi"></p>
			<input type="submit" name="SUBMIT">
		</form></div></td></tr>
	</table>
	</div>

</body></html>
