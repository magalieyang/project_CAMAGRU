<?php
session_start();
include('../config/catch_pdo.php');

if (isset($_SESSION['username'])){
if ($_SERVER['REQUEST_METHOD'] == 'POST' ){
	$title = htmlspecialchars(addslashes(trim($_POST['title'])), ENT_QUOTES | ENT_HTML5 );
	$desc = htmlspecialchars(addslashes($_POST['descriptionfile']), ENT_QUOTES | ENT_HTML5 );
	if (strlen($desc) >= 253){
		echo "<script type='text/javascript'>
		alert('The description\'s field must be 252 characters max.');
		window.location.href = './postimg.php';
		</script>";
	}
	else if (strlen($title) >= 25){
		echo "<script type='text/javascript'>
		alert('The title\'s field must be 24 characters max.');
		window.location.href = './postimg.php';
		</script>";
	}
	else if (!$title){
		echo "<script type='text/javascript'>
		alert('A title is missing.');
		window.location.href = './postimg.php';
		</script>";
	}
	else{
		if($connect && $_SESSION['user']){
			$u = $_SESSION['user'];
			$requser = "SELECT accountinfos.username, accountinfos.id, photos_tmp.path_photo
						FROM accountinfos
						INNER JOIN photos_tmp
						ON photos_tmp.username=accountinfos.username
						WHERE user LIKE '".$u."'";
			$douser = $connect->prepare($requser);
			$douser->execute();
			$resuser = $douser->fetch(PDO::FETCH_ASSOC);
			if ($resuser){
				preg_match('/\/([^\/]*)\.(\w*)$/', $resuser['path_photo'], $m);
				$id = $resuser['id'];
				$username = $resuser['username'];
				$acces_path = "../../photos/".$username."/".$m[1].".".$m[2];
				$reqinsert = "INSERT INTO gallery(iduser, title, acces_path, post_date, description)
				VALUES($id, '".$title."', '".$acces_path."', CURRENT_TIMESTAMP(), '" . $desc . "');";
				$actinsert = $connect->prepare($reqinsert);
				$actinsert->execute();

				$reqimg = 'SELECT photos_tmp.valid, photos_tmp.path_photo
							from photos_tmp
							where photos_tmp.path_photo="'.$resuser['path_photo'].'";';
				$act = $connect->prepare($reqimg);
				$act->execute();
				$result = $act->fetch();
				if ($result['valid'] == 1){
					$req="UPDATE photos_tmp
							set photos_tmp.valid=0
							where photos_tmp.path_photo ='".$resuser['path_photo']."';";
					$act = $connect->prepare($req);
					$act->execute();
				}

				$upload = rename($resuser['path_photo'], $acces_path);
					if ($upload)
						header ('Location: ../home/index.php');
				}else{
					header('Location: ../home/index.php');
				}
			}else{
				header('Location: ../home/index.php');
			}
		}
	}else{
		header('Location: ../home/index.php');}
}else{
	header('Location: ../home/index.php');}
?>
