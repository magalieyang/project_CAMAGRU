<?php
	require_once("../elements/menunav.php");
?>
<html>
	<head>
		<title>CAMAGRU</title>
		<link rel="stylesheet" href="../../css/index.css">
		<link rel="stylesheet" href="../../css/uploadfile.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script type="text/javascript" src="../../js/menunav.js"></script>
		<meta charset="UTF-8">
	</head>
	<body>
<?php
	require_once("../elements/footer.html");
	if ($_SESSION['username']){
?>
	<div class="choice">
		<center>
		<div id="selectfile" style="display : none;
									width: 600px;
									height: 500px;">
			<form method="post" enctype="multipart/form-data" action= "uploadimg.php" style="position: relative;
																							background-color: rgba(255,255,255,.8);
																							padding: 6em;
																							border: dotted #E79A7D 2px;">
			<label for="img">Selected file (JPG, JPEG or PNG):</label>
			<br><input type="file" name="img">
			<br><input type="submit" name="submit" value="Submit">
			</from>

			<a href="mygallery.php" alt="revenir"><p>Back</p></a>
		</div>
		<div id="selectmode" style="display:block" class="cyuf">
			<ul>
				<li><a href="./camagru.php" class="ltsfu" style="border-color: #18b369e0;
    															background-color: #ebffe6;	">
					<img src="../../other/camera.png" class="sifuf">
											</a>
					<div class="sdhb"><span class="fosdhb"> Take a photo </span>
				</div></li>
				<li>
					<a href="#" class="ltsfu" onclick="displayselectfile()" style="border-color: #ff5f3be0;
					    															background-color: #ffe6e6;	">
					<img src="../../other/landscape.png" class="sifuf">
									</a>
					<div class="sdhb"> <span class="fosdhb">Upload a picture</span>
								</div></li>
			</ul>
		</div>
		</center>
	</div>

	<script>
		function displayselectfile(){
			var form = document.getElementById('selectfile');
			var type = document.getElementById('selectmode');
			form.style.display = "block";
			type.style.display = "none";
		}
	</script>
	<?php
	}else{
		header("Location: ../account/loginaccount.php");
	}
	?>
</body></html>
