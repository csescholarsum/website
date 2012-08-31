<?php

$uniqname = $_POST['uniqname'];

include("../../includes/config.php");
include("../../tools/functions.php");

connect_to_db();

if (isset($_POST['name']))
{
	//profile update; error detection/correction needed
	$name = mysql_real_escape_string($_POST['name']);
	$type = mysql_real_escape_string($_POST['type']);
	$gradMonth = (int) $_POST['gradMonth'];
	$gradYear = (int) $_POST['gradYear'];
	$gpa = round(((float) $_POST['gpa']), 2);
	if (($gpa < 0)||($gpa > 4))
		$gpa = 0;
	$major = mysql_real_escape_string($_POST['major']);
	if ($_POST['resumeVisible'] == "on")
		$showResume = 1;
	else
		$showResume = 0;
	mysql_query("UPDATE members SET member_name = '$name', gradMonth = '$gradMonth', gradYear = '$gradYear', showResume = '$showResume', major = '$major', type = '$type', gpa = '$gpa'
		WHERE uniqname = '$uniqname' AND deleted=0");

	echo "Profile Updated.";
}

if (isset($_FILES['resumeFile']) && $_FILES['resumeFile']['name'] != "") {

	echo AddResume($_FILES, $uniqname);
}

header("Location: ../../index.php?slide_page=my_profile");
	

?>