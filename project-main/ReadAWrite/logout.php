<?php
	session_start();
	session_destroy();
	header("Location: unknown_homepage.php");
	exit();
?>