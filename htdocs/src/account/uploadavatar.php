<?php
session_start();
if (isset($_SESSION['username'])){
require_once('../config/catch_pdo.php');

$_FILES['img']['name'];
$_FILES['img']['type'];
$_FILES['img']['tmp_name'];
$_FILES['img']['error'] = 0;

if(isset($_FILES['img']['name'])){
if (exif_imagetype($_FILES['img']['tmp_name']) == IMAGETYPE_JPEG ||
	exif_imagetype($_FILES['img']['tmp_name']) == IMAGETYPE_PNG) {
		$extensions = array('jpg', 'jpeg', 'png');
		if (!($_FILES['img']['name']) ||
		!(preg_match('/(.*)(?=\.(jpg|jpeg|png)$)/', $_FILES['img']['name'], $m))){
			$_FILES['img']['error'] += 1;
		}
		list($a, $b) =  getimagesize($_FILES['img']['tmp_name']);
		if ($a * $b <= 1600*1200){
			if ($_FILES['img']['error'] == 0){
				$path = "../../other/tmp_saved/" . md5(uniqid(rand(), true)).".".$m[2];
				if ($connect){
					$path = md5(uniqid(rand(), true)).".".$m[2];
					$u = $_SESSION['user'];
					$req = "SELECT * FROM accountinfos WHERE user LIKE '".$u."'";
					$do = $connect->prepare($req);
					$do->execute();
					$res = $do->fetch(PDO::FETCH_ASSOC);
					if ($res){
						$id = $res['id'];
						$username = $res['username'];
						$acces_path = "../../photos/".$username."/".$path;
						$upload = move_uploaded_file($_FILES['img']['tmp_name'], $acces_path);
						$req = "UPDATE accountinfos SET avatar='".$acces_path."' WHERE username='".$username."'";
						$act = $connect->prepare($req);
						$act->execute();
						if ($act){
							echo "<script type='text/javascript'>
							alert('Your avatar has been changed.');
							window.location.href  = './accmodif.php';
							</script>";
						}
					}
				}
			}else{
				echo "<script type='text/javascript'>
				alert('An error has occurred, try to upload your file correctly.');
				window.location.href  = './accmodif.php';
				</script>";
			}
	}
	else{
		echo "<script type='text/javascript'>
		alert('An error has occurred, Your file is too big.');
		window.location.href  = './accmodif.php';
		</script>";
		}
	}else{
		echo "<script type='text/javascript'>
		alert('An error has occurred, Your image is corrupted.');
		window.location.href  = './accmodif.php';
		</script>";
		}
}else
	header ('Location: ../home/index.php');
}else
	header ('Location: ../home/index.php');
?>
