<?php
session_start();
include("./verification.php");

if (!$_SESSION['username']){

	function error($tp){
		switch($tp){
			case 0:
				echo "<script type='text/javascript'>
				alert('ERROR: You must follow the rules.');
				window.location.href='./loginaccount.php';
				</script>";
				break;
			case 1:
				echo "<script type='text/javascript'>
				alert('ERROR: Your username is not allowable.');
				window.location.href='./loginaccount.php';
				</script>";
				break;
			case 2:
				echo "<script type='text/javascript'>
				alert('ERROR: Your password is not allowable.');
				window.location.href='./loginaccount.php';
				</script>";
				break;
			case 3:
				echo "<script type='text/javascript'>
				alert('ERROR: The confirmation of the password is not the same.');
				window.location.href='./loginaccount.php';
				</script>";
				break;
			case 4:
				echo "<script type='text/javascript'>
				alert('ERROR: No empty field allowed.');
				window.location.href='./loginaccount.php';
				</script>";
				break;
		}
	}



	if (isset($_POST['password']) && isset($_POST['user']) && isset($_POST['mail'])){
		if ($_POST['mail'] == null)
			error(4);
		else if ($_POST['confirme'] != $_POST['password']){
			error(3);
		}
		else if (strlen($_POST['password']) >= 6 && strlen($_POST['user']) <= 12){
		$k = preg_match('/^(?=.*[a-z])(?=.*[0-9])(?=.*[A-Z])([\w\-\.]+)$/', $_POST['password'], $m);
		$l = preg_match('/^([A-Za-z0-9-_.]*)$/', $_POST['user'], $n);
		if ($k == 1 & $l == 1){
				if (($who = create()) != 0){
					preg_match('/[^\/]*$/', dirname(__FILE__, 2), $nm);
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					mail($who['mail'], "Validate Your account",
					"
					<html><body>
					Hello! ".$who['user']."<br />
					Welcome At CAMAGRU!<br />
					Go validate your account right now: <a href='http://localhost:8081/camagru/validateaccount.php?who=".$who['user']."&and=" . $who['username']. "' alt='link'>here</a>
					</body></html>",
					$headers);
					echo "<script type='text/javascript'>
					alert('An email has been send to validate your account. Please check it.');
					window.location.href='../home/index.php';
					</script>";
				}
				else
					error(1);
			} else{
				if (!$k && !$l)
					error(0);
				else if (!$k && $l)
					error(2);
				else if ($k && !$l)
					error(1);
			}
		}
		else
			error(0);
	}
	else
		error(4);
	}
	else
		header("Location: ../home/index.php");

?>
