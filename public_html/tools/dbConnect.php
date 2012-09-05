<?php

include ("includes/config.php");

$db = mysql_connect($hostname, $username, $password);

if (!$db)
{
	echo '<p>Error connecting to database!</p>';
	exit;
}
mysql_select_db($database, $db);


?>