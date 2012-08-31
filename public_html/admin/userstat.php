<?php
	//sets the user name to a session variable
	if (!isset($_SESSION))
		session_start();
	$user = $_SERVER['REMOTE_USER'];
	$_SESSION['UM_NAME'] = $user;
?>

