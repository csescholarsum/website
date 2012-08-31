<?php

//this file is included by other files in the admin section
//it includes the required files and validates the user

session_start();
require_once ('../connections/connection.php');
include ("../includes/config.php"); # config file with variables (required)
include("../includes/admin.php");

$db = mysql_connect("localhost", $sqluser, $sqlpass);
if (!$db)
{
	echo '<p>Error connecting to database!</p>';
	exit;
}
mysql_select_db($sqldb, $db);

$user = $_SERVER['REMOTE_USER'];
$_SESSION['USER_UNIQ'] = $user;

$query = mysql_query("SELECT * FROM admins WHERE uniquename = '$user'");

if (mysql_num_rows($query) == 0)
{
	//user is not authorized; redirect to main page
	header("Location: ../index.php");
	exit();
}

echo "Signed in as: ".$user."<br />\n";
$user = "fakeuser";
$_SERVER['REMOTE_USER'] = $user;
$user = $_SERVER['REMOTE_USER'];
echo "Changed to: ".$user;

?>
