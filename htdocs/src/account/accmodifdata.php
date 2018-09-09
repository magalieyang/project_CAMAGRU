<?php
	require_once('../config/catch_pdo.php');
	include("./verification.php");
	if (isset($_SESSION['username'])){

	function changeinfos($connect, $new2, $needed, $val){
		$new = htmlspecialchars(addslashes($new2), ENT_QUOTES | ENT_HTML5 );
		if ($connect){
			if ($val == true){
				$check = "SELECT ".$needed." FROM accountinfos WHERE " . $needed . "='".$new."'";
				$do = $connect->prepare($check);
				$do->execute();
				$res = $do->fetch(PDO::FETCH_ASSOC);
			}
			else
				$res = false;

			if (!$res){
				$usr = username($_SESSION['username'], $connect);
				$req = "UPDATE accountinfos SET ". $needed ."='".$new."' WHERE username='".$usr['username']."'";
				$act = $connect->prepare($req);
				$act->execute();
				$_SESSION[$needed] = $new;
				return(true);
			}
		}
		return(false);
	}



	if ((isset($_POST['newmail']) && isset($_POST['confirmmail']) && $_POST['newmail'] != null && $_POST['confirmmail'] != null) ||
	 (isset($_POST['newlog']) && isset($_POST['newlog']) && $_POST['newlog'] != $_SESSION['user']) ||
	  (isset($_POST['newpassword'])) || isset($_POST['notif'])) {
		$error['newlog'] = 0;
		$error['newpass'] = 0;
		$error['newmail'] = 0;
		$pass = hash('whirlpool',$_POST['newpassword']);
		if ($_POST['newmail'] != null && $_POST['confirmmail'] != NULL && $_POST['newmail'] != $_SESSION['mail'] && $_POST['newmail'] == $_POST['confirmmail']){
			if (changeinfos($connect, $_POST['newmail'], 'mail', true) == false){
				$error['newmail'] = 1;
			}
		}
		else if ($_POST['confirmmail'] && $_POST['newmail'] && $_POST['newmail'] == $_SESSION['mail']){
			$error['newmail'] = 1;
		}
		else if ($_POST['newmail'] && $_POST['confirmmail'] && $_POST['newmail'] != $_POST['confirmmail']){
			$error['newmail'] = 2;
		}
		else if ($_POST['confirmmail'] == null && $_POST['newmail'] != $_SESSION['mail']){
			$error['newmail'] = 2;
		}
		else if ($_POST['confirmmail'] != $_POST['newmail'] && $_POST['newmail'] != $_SESSION['mail']){
			$error['newmail'] = 2;
		}
		if ($_POST['newlog'] && $_POST['newlog'] != $_SESSION['user']){
			if (strlen($_POST['newlog'] >= 13 || ($ccc = preg_match('/^([A-Za-z0-9-_.]*)$/', $_POST['newlog'], $tt)) != 1)){
				$error['newlog'] = 2;
			}
			else if (trim($_POST['newlog']) == NULL){
				$error['newlog'] = 3;
			}
			else{
				if (changeinfos($connect, $_POST['newlog'], 'user', true) == false){
					$error['newlog'] = 1;
				}
			}
		}
		if ($_SESSION['password'] == $pass){
			$error['newpass'] = 2;
		}
		else if ($_POST['newpassword'] && $_SESSION['password'] != $pass){

			if ($_POST['confirmpass'] != NULL && $_POST['newpassword'] != $_POST['confirmpass']){
				$error['newpass'] = 3;
			}
			else if ($_POST['confirmpass'] != NULL && $_POST['newpassword'] == $_POST['confirmpass'])
			{
				$k = preg_match('/^(?=.*[a-z])(?=.*[0-9])(?=.*[A-Z])([\w\-\.]+)$/', $_POST['newpassword'], $m);
				if (strlen($_POST['newpassword']) >= 6 && $k == 1){
					if (changeinfos($connect, $pass, 'password', false) == false){
						$error['newpass'] = 1;
					}
				}
				else
					$error['newpass'] = -1;
			}
			else if ($_POST['newpassword'] != NULL && $_POST['confirmpass'] == NULL){
				 $error['newpass'] = 3;
			}
		}
		else if ($_POST['confirmpass'] &&
		$_POST['newpassword'] == $_POST['confirmpass'] &&
		$pass == $_SESSION['password']){
				$error['newpass'] = 2;
		}
		else if ($_POST['newpassword'] != NULL && !$_POST['confirmpass']){
			 $error['newpass'] = 3;
		}

		if ($_SESSION['notif'] == 1 && $_POST['notif'] == 2){
				changeinfos($connect, 2, 'notif', false);
		}else if ($_SESSION['notif'] == 2 && $_POST['notif'] == 1){
				changeinfos($connect, 1, 'notif', false);
		}
		if ($error['newlog'] == 0 && $error['newpass'] == 0 && $error['newmail'] == 0 ){
			echo "<script type='text/javascript'>
			alert('All informations are now updated.');
			window.location.href='./accmodif.php';
			</script>";
		}
	}
	else{
		if (isset($_POST['sub1'])){
			$error['newlog'] = 1;
			$error['newpass'] = 1;
			$error['newmail'] = 1;
		}
	}
}else{
	header("Location: ./loginaccount.php");
}

?>
