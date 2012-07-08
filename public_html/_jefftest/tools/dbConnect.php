<?php

require_once ('connections/connection.php');
include ("includes/config.php");

$db = mysql_connect("localhost", $sqluser, $sqlpass);
if (!$db)
{
	echo '<p>Error connecting to database!</p>';
	exit;
}
mysql_select_db($sqldb, $db);

?>