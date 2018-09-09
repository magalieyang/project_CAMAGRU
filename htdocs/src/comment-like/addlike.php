<?php
	session_start();

	if ($_SESSION['username'])
	{
		require_once('../config/catch_pdo.php');

		if ($connect){
			if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['sublike']){
				$idpost = $_POST['sublike'];
				$doulik = "SELECT 	accountinfos.username,
									accountinfos.id,
									gallery.idpic,
									gallery.iduser AS gallery_iduser,
									like_photos.iduser,
							        like_photos.idpost
							FROM accountinfos
							LEFT JOIN gallery
							ON gallery.idpic = $idpost
							LEFT JOIN like_photos
							ON like_photos.idpost = gallery.idpic
							WHERE accountinfos.username = '". $_SESSION['username'] ."'";
					$dodoulik = $connect->prepare($doulik);
					$dodoulik->execute();
					$reslik = $dodoulik->fetch(PDO::FETCH_ASSOC);

				if ($reslik['id'] != $reslik['gallery_iduser'] && $reslik['idpic'])
				{
					if ($reslik['idpost']){
					$reqlik = 'DELETE FROM like_photos WHERE idpost=' . $idpost;
					}else{
						$reqlik = 'INSERT INTO like_photos(iduser, idpost)
							VALUES ((SELECT accountinfos.id FROM accountinfos WHERE username="'.$_SESSION["username"] .'"), ' . $idpost. ')';

					}
					$aplike = $connect->prepare($reqlik);
					$aplike->execute();
				}
			}
		}
		if ($_POST['pos'])
			header("Location: ../home/index.php?page=" .$_POST['pos']);
		else
			header("Location: ../home/index.php");
	}else{
		header("Location: ../home/index.php");
	}
?>
