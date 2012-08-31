<?php

include("config.php");

$createLinkMessage = "";
if (isset($_POST['addRecruiter']))
{
	//adding a new member
	$name = mysql_real_escape_string($_POST['name']);
	$email = mysql_real_escape_string($_POST['email']);
	$password = mysql_real_escape_string($_POST['password']);
	if ($_POST['createLink'] == "on")
	{
		$email = "";
		$password = "";
	}
	else
	{
		if ($email == "")
			$email = "temp@temp.com";
		if ($password == "")
			$password = "password";
	}
	mysql_query("INSERT INTO recruiters (name, email, password)
		VALUES ('$name', '$email', '$password')");
	if ($_POST['createLink'] == "on")
	{
		$id = mysql_insert_id();
		$uid = sha1($id."CSESCHOLARS".$name);
		$link = "https://www.eecs.umich.edu/~cseschol/recruiters/signup.php?id=$id&uid=$uid";
		$createLinkMessage = "<br />Send this link to the recruiter: $link<br /><br />";
	}
}

if (isset($_GET['delete']))
{
	$member_id = (int) $_GET['delete'];
	mysql_query("DELETE FROM recruiters WHERE id = '$member_id' LIMIT 1");
}


$pageTitle = "Admin Section";
$includeStyle = "recruiterStyle.php";
$indirection = "../";
include("./admin_top.php");
include ("../top.php");
include("adminMenu.php"); 
echo $createLinkMessage;
?>

<div onclick="addRecruiterClick();" onmouseover="addRecruiterOver(this);" onmouseout="addRecruiterOut(this);" style="color: white; font-weight: bold; display: inline" id="addRecruiterButton">Add Recruiter</div><br />
<br />
<div id ="addRecruiterSection">
Create a profile for a new recruiter: <br /><br />

<form enctype="multipart/form-data" name="addRecruiterForm" method="post" action="recruiters.php">
Name: <input type="text" name="name" />&nbsp;&nbsp;(required)<br />
Email: <input type="text" name="email" /><br />
Password: <input name="password" type="password" /><br />
Create Link: <input name="createLink" type="checkbox" checked="checked" /> &nbsp;&nbsp;
<input type="submit" name="addRecruiter" value="Add Recruiter" />
</form>
<br />
Note: To create a link for recruiters to sign up with, leave the email and password fields blank and check the "Create Link" box. When the profile is created, a link will be displayed. Send this link to the recruiter to send them to a one-time sign up page.
<br />
<br />
</div>

<table>
	<tr>
		<td>&nbsp;</td>
    	<td>Name</td>
        <td>Email</td>
        <td>Password</td>
    </tr>
<?php
$query = mysql_query("SELECT * FROM recruiters");

if (mysql_num_rows($query) == 0)
{
?>
	<tr>
		<td>&nbsp;</td>
    	<td>-</td>
        <td>-</td>
        <td>-</td>
    </tr>
<?php
}
else
{
	while ($userData = mysql_fetch_row($query))
	{
		list($uid, $recruiter_name, $recruiter_email, $recruiter_password) = $userData;
		echo "\t<tr>\n";
		echo "\t\t<td id=\"deleteStyle\" onMouseOut=\"this.style.cursor = 'auto';\" onMouseOver=\"this.style.cursor = 'pointer';\" onclick=\"window.location='recruiters.php?delete=$uid'\">X</td>\n";
		echo "\t\t<td>".$recruiter_name."</td>\n";
		echo "\t\t<td>".$recruiter_email."</td>\n";
		echo "\t\t<td>".$recruiter_password."</td>\n";
		echo "\t</tr>\n";
	}
}
?>
</table>
<?php
include ("../side.php");
include ("../bottom.php");
?>
