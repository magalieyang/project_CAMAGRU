<?php
	session_start();
	require_once('../config/catch_pdo.php');
?>
<div class="header">
<?php
	if (isset($_SESSION['username'])){
?>
	<!-- ON THE LEFT -->
		<div class="iconmenul iconm" id="homeicon">
			<a href="../home/index.php" style="position:inherit;margin:0;padding:0;width:100%;"><img src="../../other/icons8-home-50.png" alt="home" title="home" ></a>
		</div>
		<div class="iconmenul iconm" id="photoicon">
			<a href="../pictures/camagru.php" style="position:inherit;margin:0;padding:0;width:100%;"><img src="../../other/icons8-compact-camera-50.png" alt="cam" title="cam" ></a>
		</div>
<!-- ON THE RIGHT -->

		<!-- IF THE SIZE OF THE WINDOW IS UNDER 1024PX start !-->
		<ul id="menusmallview" style="display:none;" class="tul">
			<li class="tm"><a style="margin: 0;" href="../pictures/mygallery.php" alt="link">Take or Upload a Picture</a></li>
			<li class="tm"><a style="margin: 0;" href="../pictures/gallery.php?user=<?php echo $_SESSION['user'];?>" alt="link">My Gallery</a></li>
			<li class="tm"><a style="margin: 0;" href="../account/accmodif.php" alt="link">My Account</a></li>
			<li class="tm"><a style="margin: 0;" href="../account/logout.php" alt="link">Log Out</a></li>
		</ul>
		<script>
			var mmsv = document.getElementById('menusmallview');
			function dmsv(){
				if (document.getElementById('menusmallview').style.display == "none")
					mmsv.style.display = "block"
				else
					mmsv.style.display = "none"
			}
		</script>
		<!-- IF THE SIZE OF THE WINDOW IS UNDER 1024PX end !-->


		<div class="iconmenur iconm" id="loginicon">
			<a href="../account/logout.php" style="position:inherit;margin:0;padding:0;width:100%;"><img src="../../other/icons8-shutdown-50.png" alt="logout" title="logout" ></a>
		</div>
		<div class="iconmenur iconm" id="searchicon">
			<a href="../pictures/gallery.php?user=<?php echo $_SESSION['user'];?>" style="position:inherit;margin:0;padding:0;width:100%;"><img src="../../other/icons8-photo-gallery-50.png" alt="Gallery" title="Gallery" ></a>
		</div>
		<div class="iconmenur iconm" id="faqicon">
			<a href="../pictures/mygallery.php" style="position:inherit;margin:0;padding:0;width:100%;"><img src="../../other/icons8-modifier-limage-50.png" alt="AddFile" title="AddFile" ></a>
		</div>
		<div class="iconmenur iconm" id="menuicon" onclick="dmsv();">
			<img src="../../other/icons8-menu-50.png" alt="menu" title="" id="mmsvi">
		</div>

<?php
	}else{
?>
		<div class="iconmenul iconm" id="homeicon">
			<a href="../home/index.php" style="position:inherit;margin:0;padding:0;width:100%;"><img src="../../other/icons8-home-50.png" alt="home" title="home" ></a>
		</div>
		<div id="photoicon" class="nonemnv"></div>
		<div id="searchicon" class="nonemnv"></div>
		<div id="faqicon" class="nonemnv"></div>
		<div  id="loginicon" class="nonemnv"></div>
		<div class="iconmenur iconm">
			<a href="../account/loginaccount.php" style="position:inherit;margin:0;padding:0;width:100%;"><img src="../../other/icons8-login-50.png" alt="login" title="login" ></a>
		</div>
		<div class="iconmenur iconm" id="menuicon"></div>

<?php
}
?>
</div>
