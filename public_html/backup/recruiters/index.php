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

//check if logged in
$loggedIn = ($_SESSION['recruiter'] == "LOGGED_IN");

//check if logging in
$loginAttempt = false;
if (isset($_POST['login']))
{
	$email = $_POST['email'];
	$password = $_POST['password'];
	$query = mysql_query("SELECT * FROM recruiters WHERE email = '$email'");
	if (mysql_num_rows($query) == 0)
		$loginAttempt = true;
	else
	{
		list($id, $name, $email, $realPassword) = mysql_fetch_row($query);
		if ($realPassword == $password)
		{
			$_SESSION['email'] = $email;
			$_SESSION['name'] = $name;
			$_SESSION['id'] = $id;
			$_SESSION['recruiter'] = "LOGGED_IN";
			$loggedIn = true;
		}
		else
			$loginAttempt = true;
	}
	
}

if ($loggedIn)
{
	if (isset($_POST['logOut']))
	{
		//logout
		unset($_SESSION['recruiter']);
		$loggedIn = false;
	}
}

$pageTitle = "Recruiter Section";
$indirection = "1";
include ("../top.php");
include("adminMenu.php"); 

if ($loggedIn)
{
?>
<form name="logOutForm" action="index.php" method="post">
<input type="submit" name="logOut" value="Log Out" />
</form> <br /><br /><br />
<table>
	<tr>
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
			continue;
		$member_email = $uniqname."@umich.edu";
		if ($hasResume && $showResume)
		{
			$resumeLink = "../resumes/".$uniqname.".pdf";
			$resumeLink = "<a href=\"".$resumeLink."\">View Resume</a>";
		}
		else
			$resumeLink = "-------";
		echo "\t<tr>\n";
		echo "\t\t<td>".$member_name."</td>\n";
		echo "\t\t<td><a href=\"mailto:".$member_email."\">".$member_email."</a></td>\n";
		echo "\t\t<td>".$major."</td>\n";
		echo "\t\t<td>".FormatGradDate($gradMonth, $gradYear)."</td>\n";
		echo "\t\t<td>".$resumeLink."</td>\n";
		echo "\t</tr>\n";
	}
}
?>
</table>
<?php
}
else
{
?>

Log In <?php if ($loginAttempt) echo " - Login failed, try again"; ?><br /><br />
<form name="signInForm" method="post" action="index.php">
Email: <input type="text" name="email"  /><br />
Password: <input type="password" name="password"  /> <input type="submit" name="login" value="Log In" />
</form>

<?php
}
include ("../side.php");
include ("../bottom.php");
?>