<?php

$sub= "Alerts Page";
include 'monitor.php';
include 'functions.php';

$alertError = false;
if (isset($_POST['createAlert']))
{
	//user is registering
	$name = $_POST['name'];
	$time = $_POST['time'];
	$date = $_POST['date'];
	$recipient = $_POST['recipient'];
	$email = $_POST['email'];
	$message = $_POST['message'];
	if (ValidateAlert($name, $time, $date, $recipient, $email, $message))
		AddAlert($name, $time, $date, $recipient, $email, $message);
	else
		$alertError = true;
}


?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="alerts_page_style.css" rel="stylesheet" type="text/css">
<title>Page title here</title>

<script type="text/javascript">

var validColor = "white";
var errorColor = "red";

function FormValidation(formPtr)
{
	var formError = false;
	if (formPtr.name.value == "")
	{
		formPtr.name.style.background = errorColor;
		formError = true;
	}
	else
		formPtr.name.style.background = validColor;
    if (formPtr.date.value == "")
	{
		formPtr.date.style.background = errorColor;
		formError = true;
	}
	else
		formPtr.date.style.background = validColor;
	if (formPtr.time.value == "")
	{
		formPtr.time.style.background = errorColor;
		formError = true;
	}
	else
		formPtr.time.style.background = validColor;
    if (formPtr.recipient.value == "")
	{
		formPtr.recipient.style.background = errorColor;
		formError = true;
	}
	else
		formPtr.recipient.style.background = validColor;
	if (formPtr.email.value == "")
	{
		formPtr.email.style.background = errorColor;
		formError = true;
	}
	else
		formPtr.email.style.background = validColor;
	if (formError)
	{
		document.getElementById('errorDiv').style.display = "block";
		return false;
	}
	return true;
}

</script>

</head>

<body<?php if ($alertError) echo " onload=\"FormValidation(document.forms[0]);\""; ?>>

<div id="main">
	<div id="nav">
    	<span">Welcome, Harsh!</span>
        <span style="float: right;">
    	<span id="blueButton" onClick="document.location = 'profile.php';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Edit Profile&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span id="blueButton" onClick="document.location = 'logout.php';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Logout&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
        </span>
    </div>
    <div id="alertTable">
    <span id="blueHeader">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Existing Alerts&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
    <br /><br />
    <table cellpadding="10">
    	<thead>
        	<th>Alert Name</th>
            <th>Trigger Date</th>
            <th>Trigger Time</th>
            <th>Recipient</th>
            <th>Recipient email</th>
            <th>Message to recipient</th>
            <th>Time to trigger</th>
            <th>Email sent</th>
        </thead>
    </table>
    <div style="text-align: center; padding: 20px">You have no active alerts</div>
    </div>
    <div id="createAlert">
    		<span id="blueHeader">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Create a New Alert&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><br /><br />
            <div id="errorDiv">Error: Please fix marked fields before submitting</div>
			<form id="alertForm" method="post" onSubmit="return FormValidation(this)" >
			<table>
			<tr>
				<td>Alert Name:</td>
				<td><input type="text" name="name" value="<?php if ($alertError) echo $name ?>" /></td>
			</tr>
			<tr>
				<td>Trigger Date:</td>
				<td><input type="text" name="date" value="<?php if ($alertError) echo $date ?>" /></td>
			</tr>
			<tr>
				<td>Trigger Time:</td>
				<td><input type="text" name="time" value="<?php if ($alertError) echo $time ?>" /></td>
			</tr>
			<tr>
				<td>Recipient:</td>
				<td><input type="text" name="recipient" value="<?php if ($alertError) echo $recipient ?>" /></td>
			</tr>
			<tr>
				<td>Recipient email:</td>
				<td><input type="text" name="email" value="<?php if ($alertError) echo $email ?>" /></td>
			</tr>
			<tr>
				<td>Message to recipient:</td>
				<td><input type="text" name="message" value="<?php if ($alertError) echo $message ?>" /></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input style="background-color: #00AA00; color: white; border: 0;" type="submit" name="createAlert" value="Create" /></td>
			</tr>
			</table>
			</form>
    </div>
    <div id="footer"><?php include("footer.php"); ?></div>
</div>

</body>
</html>

