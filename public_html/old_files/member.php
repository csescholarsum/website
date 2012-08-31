<?php

session_start();
require_once ('connections/connection.php');
include ("includes/config.php"); # config file with variables (required)
include("includes/admin.php");

$db = mysql_connect("localhost", $sqluser, $sqlpass);
if (!$db) {
	echo '<p>Error connecting to database!</p>';
	exit;
}
mysql_select_db($sqldb, $db);

$user = $_SERVER['REMOTE_USER'];


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Member Section</title>
</head>

<body>
<?php
$query = mysql_query("SELECT *  FROM members
								");
	$name = mysql_fetch_row($query);
	echo "<".$name[0].">";
	echo "<".$name[1].">";
	echo "<".$name[2].">";
	echo "<".$name[3].">";
	echo "<".$name[4].">";
	echo "<".$name[5].">";
	echo "<".$name[6]."><br /><br />";
	
	$query = mysql_query("SELECT * FROM about");
	list($description, $applinfo, $welcomeday, $freshmanday) = mysql_fetch_row($query);

	echo "<div>*$description</div>";
	echo "<div>*$welcomeday</div>";
	echo "<div>*$freshmanday</div>";
	?>
</body>
</html>
