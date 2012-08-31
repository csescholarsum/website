<?php

include("config.php");

if (isset($_POST['addRecruiter']))
{
	//adding a new member
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	mysql_query("INSERT INTO recruiters (name, email, password)
		VALUES ('$name', '$email', '$password')");
}

if (isset($_GET['delete']))
{
	$member_id = (int) $_GET['delete'];
	mysql_query("DELETE FROM recruiters WHERE id = '$member_id' LIMIT 1");
}


$pageTitle = "Admin Section";
$includeStyle = "recruiterStyle.php";
$indirection = "1";
include ("../top.php");
include("adminMenu.php"); 

?>

<div onclick="addRecruiterClick();" onmouseover="addRecruiterOver(this);" onmouseout="addRecruiterOut(this);" style="color: white; font-weight: bold; display: inline" id="addRecruiterButton">Add Recruiter</div><br />
<br />
<div id ="addRecruiterSection">
<?php
if (isset($_POST['addRecruiter']) || true)
{
?>
<form enctype="multipart/form-data" name="addRecruiterForm" method="post" action="recruiters.php">
Name: <input type="text" name="name" /><br />
Email: <input type="text" name="email" /><br />
Password: <input name="password" type="password" />&nbsp;&nbsp;
<input type="submit" name="addRecruiter" value="Add Recruiter" />
</form>
<?php
}
?>
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
