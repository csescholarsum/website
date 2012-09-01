<?php

session_start();
require_once ('../connections/connection.php');
include ("../includes/config.php"); # config file with variables (required)
include("../includes/admin.php");
include("../functions.php");

$db = mysql_connect("localhost", $sqluser, $sqlpass);
if (!$db)
{
	echo '<p>Error connecting to database!</p>';
	exit;
}
mysql_select_db($sqldb, $db);

$user = $_SERVER['REMOTE_USER'];
$_SESSION['USER_UNIQ'] = $user;

$query = mysql_query("SELECT * FROM members WHERE uniquename = '$user'");

if (mysql_num_rows($query) == 0)
{
	//user is not authorized; redirect to main page
	header("Location: ../index.php");
	exit();
}

$userData = mysql_fetch_row($query);

list($id, $name, $uniqname, $gradMonth, $gradYear, $showResume, $hasResume, $major, $hidden, $gpa) = $userData;

if (isset($_POST['name']))
{
	//profile update; error detection/correction needed
	$name = mysql_real_escape_string($_POST['name']);
	$gradMonth = (int) $_POST['gradMonth'];
	$gradYear = (int) $_POST['gradYear'];
	$gpa = round(((float) $_POST['gpa']), 2);
	if (($gpa < 0)||($gpa > 4))
		$gpa = 0;
	$major = mysql_real_escape_string($_POST['major']);
	if (($major != "CE")&&($major != "CSE")&&($major != "CS_LSA"))
		$major = "";
	if ($_POST['resumeVisible'] == "on")
		$showResume = 1;
	else
		$showResume = 0;
	if ($_POST['profileVisible'] == "on")
		$hidden = 0;
	else
		$hidden = 1;
	mysql_query("UPDATE members SET name = '$name', gradMonth = '$gradMonth', gradYear = '$gradYear', showResume = '$showResume', major = '$major', hidden = '$hidden', gpa = '$gpa'
		WHERE uniquename = '$uniqname'");
}

$name = stripslashes($name);

include("../includes/uploadResume.php");

if (isset($_POST['deleteResume']))
{
	//delete user resume; update db and remove file
	mysql_query("UPDATE members SET hasResume = '0' WHERE uniquename = '$uniqname'");
	$hasResume = 0;
	DeleteResume($uniqname);
}

$pageTitle = "Member Section";
$indirection = "../";
include ("../top.php");
echo "<h3>&nbsp;Your Member Profile</h3>\n\n";
if ($uploadFailed)
{
	if ($notPDF)
		echo "Resume must be a pdf!<br /><br />\n\n";
	else
		echo "File upload failed!<br /><br />\n\n";
}

if ($hidden)
	$hiddenText = "Not Visible";
else
	$hiddenText = "Visible";
	
/*echo "Name: ".$name."<br />\n";
echo "Uniqname: ".$uniqname."<br />\n";
echo "Major: ".$major."<br />\n";
echo "Graduation: ".FormatGradDate($gradMonth, $gradYear)."<br />\n";
echo "Has Resume: ".$hasResume."<br />\n";
echo "Show Resume: ".$showResume."<br />\n";
echo "Profile Visible: ".$hiddenText."<br /><br /><br />\n\n";*/

?>

<form name="updateUser" method="post" action="index.php">
    <table>
    <tr><td>Name: </td><td><input name="name" type="text" value="<?php echo $name; ?>"  /></td></tr>
    <tr><td>Uniqname: </td><td><?php echo $uniqname; ?></td></tr>
    <tr>
    	<td>Major: </td>
    	<td>
        	<select name="major">
            	<option value=""></option>
            <option value="EE"
              <?php if ($major == "EE") echo " selected=\"selected\""; ?>>EE
            </option>
            	<option value="CSE"<?php if ($major == "CSE") echo " selected=\"selected\""; ?>>CSE</option>
                <option value="CE"<?php if ($major == "CE") echo " selected=\"selected\""; ?>>CE</option>
                <option value="CS-LSA"<?php if ($major == "CS-LSA") echo " selected=\"selected\""; ?>>CS_LSA</option>
            </select>
    	</td>
    </tr>
    <tr><td>Graduation: </td><td><input name="gradMonth" type="text" maxlength="2" size="3" value="<?php echo $gradMonth; ?>"  />, <input name="gradYear" type="text" maxlength="4" size="4" value="<?php echo $gradYear; ?>"  /> (mm yyyy)</td></tr>
    <tr><td>GPA: </td><td><input name="gpa" size="4" type="text" value="<?php PrintGPA($gpa); ?>" /> Your GPA will only be visible to recruiters</td></tr>
    <tr><td>Resume Visible: </td><td><input name="resumeVisible" type="checkbox" <?php if ($showResume) echo "checked=\"checked\""; ?>  /></td></tr>
    <tr><td>Profile Visible: </td><td><input name="profileVisible" type="checkbox" <?php if (!$hidden) echo "checked=\"checked\""; ?>  /></td></tr>
    <tr><td>&nbsp;</td><td><input type="submit" value="Update Profile" /></td></tr>
    </table>
</form>
<br /><br />
<?php
if ($hasResume)
{
	echo "\n<a href=\"../resumes/".$uniqname.".pdf\">View Resume</a>\n";
?>
<form name="deleteResumeForm" action="index.php" method="post">
<input type="submit" name="deleteResume" value="Delete Resume" />
</form>
<?php
}
else
{
	echo "\nNo resume on file\n";
}
?>
<br /><br />
<form enctype="multipart/form-data" name="uploadResume" method="post" action="index.php">
	Resume: <input type="file" name="resumeFile"  /> (must be a pdf, will overwrite existing resume)<br />
    <input type="submit" value="Upload Resume" />
</form>
<br /><br />
<form name="deleteProfileForm" action="index.php" method="post">
<input type="submit" name="deleteProfile" value="Delete Profile" />
</form>
<?php
include ("../side.php");
include ("../bottom.php");
?>