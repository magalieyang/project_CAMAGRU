<?php
session_start();
require_once('../config/catch_pdo.php');

if ($_SESSION['username']){
	$quoted = trim(htmlspecialchars(addslashes($_POST['commentaire']), ENT_QUOTES | ENT_HTML5));
	$connect = new PDO($DB_DSN , $DB_USER, $DB_PASSWORD);
		if($_POST['pict'] && $quoted != NULL && $connect){
			$compo = $_POST['pict'];

			$ifexists = "SELECT gallery.idpic, comm.idpost, accountinfos.notif, accountinfos.user, accountinfos.mail, accountinfos.id, gallery.iduser
							FROM gallery
			                LEFT JOIN comm
			                ON comm.idpost=gallery.idpic
                            LEFT JOIN accountinfos
                            ON gallery.iduser = accountinfos.id
			                WHERE gallery.idpic = ". $compo .";";
			$check = $connect->prepare($ifexists);
			$check->execute();
			$rescheck = $check->fetch(PDO::FETCH_ASSOC);
			if ($rescheck['idpic']){
				$addcom = "INSERT INTO comm (iduser, idpost,content, post_date)
							VALUES ((SELECT accountinfos.id FROM accountinfos WHERE username='". $_SESSION['username'] ."'),
						 ". $compo . " , '". $quoted . "', CURRENT_TIMESTAMP); ";
				$addcomdo = $connect->prepare($addcom);
				$addcomdo->execute();

				if ($rescheck['notif'] == 1)
				{
				//Envois de l'email
				$headers  = 'MIME-Version: 1.0' . "\r\n";
     			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				mail($rescheck['mail'], "You have a new commentary on your picture",
				"
				<html><body>
				Hello! ".$rescheck['user']."<br />
				A new commentary has been added to your picture!<br />
				You can find all commentaries on the home page: <a href='http://localhost:8081/camagru/index.php' alt='link_newcom'>here</a>
				</body></html>",
				$headers);
				//fin de l 'envois'
				}
			}
		}
	if ($_POST['pos'])
		header("Location: ../home/index.php?page=" . $_POST['pos']);
	else
		header("Location: ../home/index.php");
}else{
	header("Location: ../account/loginaccount.php");
}


?>
