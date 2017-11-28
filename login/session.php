<?php
	/* session.php - to be included for session management */
	session_start();
	$_SESSION["cyan"] = "rgba(0, 255, 255, 1)";
	print_r($_SESSION);
?>