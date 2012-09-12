<?php

include("../../tools/functions.php");

connect_to_db();

//Check if title is null
if ($_REQUEST['title'] == "" ) {
	echo "Title is empty.";
	return;
}

if (!isset($_REQUEST['serhours'])) {

	$_REQUEST['serhours'] = 0;
}

$title = mysql_real_escape_string($_REQUEST['title']);
$date = mysql_real_escape_string($_REQUEST['date']);
$serhours = mysql_real_escape_string($_REQUEST['serhours']);

mysql_query("INSERT INTO
 `events`( `Title`, `Date`, `SerHours`)
 VALUES ('$title', '$date', '$serhours')");

echo "Event successfully recorded."

?>