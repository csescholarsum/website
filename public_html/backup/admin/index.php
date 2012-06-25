<?php 

include("config.php");
include("../functions.php");

if (isset($_POST['addMember']))
{
	//adding a new member
	$name = $_POST['name'];
	$uniquename = $_POST['uniquename'];
	$gradMonth = $_POST['gradMonth'];
	$gradYear = $_POST['gradYear'];
	$major = $_POST['major'];
	if ($_POST['resumeVisible'] == "on")
		$showResume = 1;
	else
		$showResume = 0;
	//error detection here
	$hasResume = false;
	$uploadFailed = false;
	if (isset($_FILES['resumeFile']))
	{
		$target_path = "../resumes/".$uniqname.".pdf"; 
		
		if ($_FILES['resumeFile']['tmp_name'] != "")
		{
			//check if file ends with ".pdf"
			if (substr_compare($_FILES['resumeFile']['name'], ".pdf", -4) === 0)
			{
				if(move_uploaded_file($_FILES['resumeFile']['tmp_name'], $target_path))
				{
					mysql_query("UPDATE members SET hasResume = '1' WHERE uniquename = '$uniqname'");
					$hasResume = 1;
				}
				else
				{
					$uploadFailed = true;
					$notPDF = false;
				}
			}
			else
			{
				$uploadFailed = true;
				$notPDF = true;
			}
		}
	}
	mysql_query("INSERT INTO members (name, uniquename, gradMonth, gradYear, showResume, hasResume, major)
		VALUES ('$name', '$uniquename', '$gradMonth', '$gradYear', '$showResume', '$hasResume', '$major')");
}

if (isset($_GET['delete']))
{
	$member_id = (int) $_GET['delete'];
	mysql_query("DELETE FROM members WHERE id = '$member_id' LIMIT 1");
}
//$pageTitle = "Admin Section";
$includeStyle = "indexStyle.php";
$indirection = "1";
include ("../top.php");
include("adminMenu.php"); 
if ($uploadFailed)
{
	if ($notPDF)
		echo "Resume must be a pdf!<br /><br />\n\n";
	else
		echo "File upload failed!<br /><br />\n\n";
}
?>
<div onclick="addMemberClick();" onmouseover="addMemberOver(this);" onmouseout="addMemberOut(this);" style="color: white; font-weight: bold; display: inline" id="addMemberButton">Add Member</div><br />
<br />
<div id ="addMemberSection">
<form enctype="multipart/form-data" name="addMemberForm" method="post" action="index.php">
    <table>
    <tr><td>Name: </td><td><input name="name" type="text" /></td></tr>
    <tr><td>Uniqname: </td><td><input type="text" name="uniquename" /></td></tr>
    <tr>
    	<td>Major: </td>
    	<td>
        	<select name="major">
            	<option value=""></option>
            	<option value="CSE">CSE</option>
                <option value="CE">CE</option>
                <option value="CS-LSA">CS_LSA</option>
            </select>
    	</td>
    </tr>
    <tr><td>Graduation: </td><td><input name="gradMonth" type="text" maxlength="2" size="3" />, <input name="gradYear" type="text" maxlength="4" size="4" /> (mm yyyy)</td></tr>
    <tr><td>Resume: </td><td><input type="file" name="resumeFile"  /> (must be a pdf)</td></tr>
    <tr><td>Resume Visible: </td><td><input name="resumeVisible" type="checkbox" checked="checked" /></td></tr>
    <tr><td>&nbsp;</td><td><input type="submit" name="addMember" value="Add Member" /></td></tr>
    </table>
</form>
</div>
<table>
	<tr>
		<td>&nbsp;</td>
    	<td>Name</td>
        <td>Email</td>
        <td>Major</td>
        <td>Graduation</td>
        <td>Resume</td>
    </tr>
<?php
$query = mysql_query("SELECT * FROM members");

if (mysql_num_rows($query) == 0)
{
?>
	<tr>
    	<td>&nbsp;</td>
    	<td>-</td>
        <td>-</td>
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
		list($uid, $member_name, $uniqname, $gradMonth, $gradYear, $showResume, $hasResume, $major) = $userData;
		if ($member_name == "")
			$member_name = "No Name";
		$member_email = $uniqname."@umich.edu";
		if ($hasResume)
		{
			$resumeLink = "../resumes/".$uniqname.".pdf";
			$resumeLink = "<a href=\"".$resumeLink."\">View Resume</a>";
		}
		else
			$resumeLink = "-------";
		echo "\t<tr>\n";
		echo "\t\t<td id=\"deleteStyle\" onMouseOut=\"this.style.cursor = 'auto';\" onMouseOver=\"this.style.cursor = 'pointer';\" onclick=\"window.location='index.php?delete=$uid'\">X</td>\n";
		echo "\t\t<td><a href=\"viewmember.php?user=".$uniqname."\">".$member_name."</a></td>\n";
		echo "\t\t<td>".$member_email."</td>\n";
		echo "\t\t<td>".$major."</td>\n";
		if (($gradMonth < 1)||($gradMonth > 12))
			echo "\t\t<td>&nbsp;</td>\n";
		else
			echo "\t\t<td>".$gradMonth."/".$gradYear."</td>\n";
		echo "\t\t<td>".$resumeLink."</td>\n";
		echo "\t</tr>\n";
	}
}
?>
</table>

          
<?php
include ("../side.php");
include ("../bottom.php");
?>


