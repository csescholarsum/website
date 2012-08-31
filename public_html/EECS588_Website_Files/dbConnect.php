<?php
session_start();
$hostname = "localhost";
$database = "csescholars";
$username = "cseschol";
$password = "JAwNuTrJ";
$includesDB = true;
$connection = mysql_pconnect($hostname, $username, $password) or die(mysql_error());
include ("includes/config.php");

$db = mysql_connect("localhost", $sqluser, $sqlpass);
if (!$db)
{
	echo '<p>Error connecting to database!</p>';
	exit;
}
mysql_select_db($sqldb, $db);

//check if logged in

$user = $_SERVER['REMOTE_USER'];

//begin test content

if (isset($_GET['user']))
{
	$_SESSION['user'] = $_GET['user'];
	$user = $_GET['user'];
}
else
{
	if (isset($_SESSION['user']))
		$user = $_SESSION['user'];
}

//end test content

$query = mysql_query("SELECT * FROM 588users WHERE uniqname = '$user' LIMIT 1");
if (mysql_num_rows($query) == 0)
{
	$loggedin = false;
}
else
{
	$loggedin = true;
	$data = mysql_fetch_row($query);
	$name = $data['2'];
	$userID = $data['0'];
}

?>
