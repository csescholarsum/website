<?php

	//this file is included by <resume>.pdf
	//what I would like to do is make any request to this directory go through a single file which will with return a file or not
	
	function ThrowNotFound()
	{
		header("HTTP/1.1 404 Not Found");
		include("notfound.php");
		exit();
	}
	
	session_start();
	require_once ('../connections/connection.php');
	include ("../includes/config.php"); # config file with variables (required)
	include("../includes/admin.php");
	
	$db = mysql_connect("localhost", $sqluser, $sqlpass);
	if (!$db)
		ThrowNotFound();
	mysql_select_db($sqldb, $db);

	//uniquename should already be set; throw not found if not
	if ((!isset($uniquename)) || ($uniquename == ""))
		ThrowNotFound();

	//check if this user is logged in as a recruiter
	if ($_SESSION['recruiter'] != "LOGGED_IN")
	{
		//not recruiter; check if admin
		$user = $_SESSION['USER_UNIQ'];
		$query = mysql_query("SELECT * FROM admins WHERE uniquename = '$user'");
		if ((mysql_num_rows($query) == 0) || ($user == ""))
		{
			//not admin; check if normal user
			if ($user != $uniquename)
				ThrowNotFound();
		}
	}
	
	$file = "../../resumes/".$uniquename.".pdf";

	//check if file exists; throw not found if not
	if (!file_exists($file))
		ThrowNotFound();

	//set headers and include pdf
	header('Accept-Ranges: bytes');
	header('Content-Type: application/pdf');
	readfile($file);
	exit();

?>
