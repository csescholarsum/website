<?php

//NOTE THERE IS STILL A BUG WITH THE SCRIPTS 
//RUNNING MULTIPLE TIMES BUT THIS IS A TEMP FIX

include("../../tools/functions.php");

connect_to_db();

//Check if name or uniqname is null
if ($_REQUEST['name'] == "" || $_REQUEST['uniqname'] == "") {
	echo "name or uniqname is empty.";
	return;
}

$event_id = mysql_real_escape_string($_REQUEST['eventID']);
$name = mysql_real_escape_string($_REQUEST['name']);
$uniqname = mysql_real_escape_string($_REQUEST['uniqname']);

$result = mysql_query("SELECT * FROM attendies WHERE Uniqname='$uniqname' AND deleted=0");

if (mysql_num_rows($result) == 0) {

	mysql_query("INSERT INTO
	 `attendies`( `eventID`, `Name`, `Uniqname`)
	 VALUES ($event_id, '$name', '$uniqname')");

	echo "Attendance successfully recorded.";
}

?>