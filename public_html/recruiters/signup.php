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
if ($_SESSION['recruiter'] == "LOGGED_IN")
{
	header("Location: index.php");
	exit();
}

$id = (int) $_GET['id'];
$uid = $_GET['uid'];

$query = mysql_query("SELECT * FROM recruiters WHERE id = '$id'");
if (mysql_num_rows($query) == 0)
{
	//no id; what should happen?
	$errorMSG = "Error: There is no profile in the database that matches this id. Please contact CSE Scholars if this is a mistake.";
}
else
{
	list($id, $name, $email, $realPassword) = mysql_fetch_row($query);
	if (($email != "")||($realPassword != ""))
	{
		//already set; what should happen?
		$errorMSG = "This profile is already complete. Please contact CSE Scholars if you cannot remember your password.";
	}
	else
	{
		$uid_check = sha1($id."CSESCHOLARS".$name);
		if ($uid != $uid_check)
			$errorMSG = "Error: Your link is not valid. Please contact CSE Scholars if this is a mistake.";
		else
		{
			if (isset($_POST['signup']))
			{
				$email = mysql_real_escape_string($_POST['email']);
				$password = mysql_real_escape_string($_POST['password']);
				if (($email == "")||($password == ""))
					$errorMSG = "Error: Neither your email nor password may be left blank.";
				else
				{
					$_SESSION['recruiter'] = "LOGGED_IN";
					mysql_query("UPDATE recruiters SET email = '$email', password = '$password'	WHERE id = '$id'");
					header("Location: index.php");
					exit();
				}
			}
		}
	}
}

$pageTitle = "Recruiter Sign Up";
$indirection = "../";
include ("../top.php");
?>

<h3>Create Recruiter Profile</h3><br />
<?php
if ($errorMSG != "")
	echo $errorMSG."<br /><br />";
?>
<form name="signUpForm" method="post" action="signup.php?id=<?php echo $id."&uid=".$uid; ?>">
Name: <?php echo $name; ?><br />
Email: <input type="text" name="email"  /><br />
Password: <input type="password" name="password"  /> <input type="submit" name="signup" value="Create Profile" />
</form>
<br /><br />
Note: You will need your email and password combination to view student resumes. If you forget either of these values, you will need to contact CSE Scholars to sign in. Neither of these two values may be left blank.

<?php
include ("../side.php");
include ("../bottom.php");
?>
