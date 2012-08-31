<?
##################################################################################
#  U-M CSE Scholars CMS - Public Page Header 
##################################################################################

// Checks to make sure the user is logged in every time the page loads
$db = mysql_connect("localhost", $sqluser, $sqlpass);
if (!$db) {
	echo '<p>Error connecting to database!</p>';
	exit;
}
mysql_select_db($sqldb, $db);

if ($_POST['uniqname'] && $_POST['password']) {
	$_SESSION['uniqname'] = $_POST['uniqname'];
	$_SESSION['password'] = $_POST['password'];
}
	

$db = mysql_connect("localhost", $sqluser, $sqlpass);
if (!$db) {
	echo '<br><font color="#FF0000">Error connecting to database!</font>';
	exit;
}
mysql_select_db($sqldb, $db);

?>
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="generator" content="Bluefish 1.0.7">
<link href="style.css" rel="stylesheet" type="text/css">
<title>CSE Scholars: University of Michigan</title>
</head>

<body>
<div id="header">
	<div id="logo">
		<h1><a href="index.php?sec=home">&lt;cse.scholars&gt;</a></h1>
		<h2>University of Michigan</h2>
	</div>



	<div id="menu">
	        <div id="about">
	                <ul>
					 	<li class="first"><a href="index.php">About CSE Scholars</a></li>
						<li><a href="index.php?sec=blog">Blog</a></li>
					 	<li><a href="index.php?sec=calendar">Calendar</a></li>
					 	<li><a href="index.php?sec=contact">Contact</a></li>
						<li><a href="index.php?sec=app">Application</a></li>
					 	<!--<li><a href="index.php?sec=events">Events</a></li>-->
					 	<li><a href="http://www.eecs.umich.edu/LearningCenter/">EECS Learning Center</a></li>
						<li><a href="index.php?sec=profiles">Member List</a></li>
					 	<!--<li><a href="index.php?sec=faq">Course Guide & FAQ</a></li>-->
		             	<!--<li><a href="index.php?sec=recruiting">Recruiting</a></li>-->
					</ul>
	        </div>
<?php
				//echo $_SESSION['uniqname'];
				//echo session_id();
				
								?>
	</div>


</div>

<!-- start page -->
<div id="page">
<div id="content">
