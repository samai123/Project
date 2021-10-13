<?php session_start();?>
<?php
if(!$_SESSION['UserID']){
	Header("Location: LoginFrom.php");
}else{?>
	<!doctype html>
	<html>
		<head>
			<title>Home</title>
		</head>
		<body>
			<?php print_r($_SESSION)?>
			<a href="logout.php">Log out</a></strong></p>
			<a href="shelf.php">shelf</a></strong></p>
			<a href="changeprofilefrom.php">changeprofile</a></strong></p>
			<a href="showpic.php">testpic</a></strong></p>
		</body>
	<html>
<?php }?>