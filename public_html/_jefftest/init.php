<?php

/*
Created by jsallans
6-27-2012
PURPOSE: This file has all the include statements needed
*/

include("includes/config.php");
require_once("tools/functions.php");

?>

<!DOCTYPE html>

<head>
	<!--jQuery-->
	<script type="text/javascript" src="_jquery-ui/js/jquery-1.7.2.min.js"></script>

	<!--jQuery UI-->
	<link type='text/css' href='_jquery-ui/css/redmond/jquery-ui-1.8.21.custom.css' rel='stylesheet' />
	<script type="text/javascript" src="_jquery-ui/js/jquery-ui-1.8.21.custom.min.js"></script>

	<!--APIs/Plugins-->
	<link type='text/css' href='_dataTables/jquery.dataTables.css' />
	<script type="text/javascript" src='_dataTables/jquery.dataTables.js'></script>

	<!--CSS folder-->
	<link type='text/css' href='css/style.css' rel='stylesheet' />

	<!--JS folder-->

<?php
	//edit by jsallans
	//7-2-12
	//add extention for popup box
	//template:
	// message_popup(title, message, mins open, link);
	include('tools/message_popup.php');
?>

</head>
