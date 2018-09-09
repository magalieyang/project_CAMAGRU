<?php
	require_once("../elements/menunav.php");
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
<?php
	include("../elements/footer.html");
	if (!isset($_SESSION['username'])){
?>

<div class="dataarea">
	<table>
	<tr><th>LOG IN</th>
		<th>CREATE A NEW ACCOUNT</th>
	</tr>
	<tr>
	<td>
	<div class="personnalinfos">
	<form action="./login.php" method="post" name="formulaire" autoComplete="off">
		<p>USERNAME: <input type="text" name="user" value="" autoComplete="off"></p>
		<p>PASSWORD: <input name="password" value="" type="password" autoComplete="off"></p>
		<input type="submit" name="SUBMIT">
	</form>
	<br /><a href='./forgetpwd.php' title='password_forgotten' alt='pwd_recover'>Forgot Password?
</div>
</td><td>
	<div class="personnalinfos">
	<form action="create.php" method="post" name="formulaire" autoComplete="off">
		<p>USERNAME: <input type="text" name="user" value="" type="password" autoComplete="off">
		<span style="font-size:.7em;">(under 12 characters. Only alphanumerics and <i>_-.</i>)</span></p>
		<p>PASSWORD: <input name="password" value="" type="password" autoComplete="off">
		<span style="font-size:.7em;">(more than 6 characters. it needs uppercase, lowercase and number)</span></p>
		<p>CONFIRM PASSWORD: <input type="password" name="confirme" value="" autoComplete="off"></p>
		<p>EMAIL: <input type="email" name="mail" autoComplete="new_email"></p>
		<input type="submit" name="SUBMIT">
	</form>
	</div>
</td></tr></table>

<?php
}else{
	header("Location: ../home/index.php");
}
?>


</body><html>
