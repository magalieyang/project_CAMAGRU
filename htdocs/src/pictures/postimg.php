<?php
	require_once("../elements/menunav.php");
?>
<html>
	<head>
		<title>CAMAGRU</title>
		<link rel="stylesheet" href="../../css/index.css">
		<link rel="stylesheet" href="../../css/cam.css">
		<link rel="stylesheet" href="../../css/uploadfile.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script type="text/javascript" src="../../js/menunav.js"></script>
		<meta charset="UTF-8">
	</head>
	<body>

<?php
	require_once("../elements/footer.html");
	if (isset($_SESSION['username']) && $connect){
		$req = "SELECT * FROM photos_tmp
				WHERE username='".$_SESSION['username']."'";
		$do = $connect->prepare($req);
		$do->execute();
		$res = $do->fetch(PDO::FETCH_ASSOC);
		if (file_exists($res['path_photo'])){
			if ($res['valid'] != 1){
				echo "<script type='text/javascript'>
				alert('You need to add at least one filter to send it.');
				window.location.href  = './mygallery.php';
				</script>";
			}
?>

<div class="bfrpst" >
	<div class="previewarea" style="background-image:url('<?php echo $res['path_photo'] ; ?>');
	<?php
		$size = getimagesize($res['path_photo']);
		// echo 'min-width:'.$size[0].'px;';
	?>
	">
	</div>
	<div class="choice_">
		<form method="post" action="./sndpstmg.php">
			<br><label for="title">Image's title (max <span id="title__sp">24</span> characters)</label><br />
			<input id="title__" type="text" name="title" value="" onkeyup="charnbr('title__')">
			<br>
			<br><label for="descriptionfile">Image's description (max <span id="desc__sp">252</span> characters)</label><br />
			<textarea id="desc__" id="textdescription" name="descriptionfile" value="" onkeyup="charnbr('desc__')"></textarea>
			<br>
			<input type="submit" name="submit" value="Submit">
		</form>

		<script>
		function charnbr(is){
			var texte = document.getElementById(is);
			var txtnbr = document.getElementById(is+'sp');
			var nbr = (is == "title__")? 24 : 252;
			var nbrprct = nbr * 25 / 100;

			nbr -= texte.value.length;
			if (nbr > 0 && nbr <= nbrprct )
				txtnbr.style.color = "#fc9f14";
			else if (nbr <= 0)
				txtnbr.style.color = "red";
			else
				txtnbr.style.color = 'black';
			txtnbr.innerHTML = nbr;
			}
		</script>

	</div>
</div>
<?php
	}
	else
		header("Location: ./mygallery.php");
	}
	else
		header("Location: ../account/loginaccount.php");
	?>
</body></html>
