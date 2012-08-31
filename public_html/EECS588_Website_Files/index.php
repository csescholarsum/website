<?php
include("dbConnect.php");

$signupfail = false;
if ((isset($_POST['name']))&&(!$loggedin))
{
	//user is trying to signup
	$name = $_POST['name'];
	if ($name == "")
		$signupfail = true;
	else
	{
		$query = mysql_query("SELECT * FROM 588users WHERE uniqname = '$user' LIMIT 1");
		if (mysql_num_rows($query) == 0)
		{
			//valid, add use
			mysql_query("INSERT INTO 588users (uniqname, name) VALUES ('$user', '$name')");
			$loggedin = true;
		}
		else
		{
			$signupfail = true;
		}
	}
}

include ("top.php");
?>



<?php

if ($loggedin)
{
?>
	<h3>588 Connections</h3>
<?php
	echo "Welcome ".$name."!";
}
else
{
?>
<h3>Sign Up for Connect 588</h3>
<?php
if ($signupfail)
{
	echo "<div style=\"color: red;\">";
	if ($name == "")
		echo "Error: Name was not specified";
	else
		echo "Error: Uniqname already in use";
	echo "</div>";
}
?>
<form name="loginform" method="post" action"index.php">
Name: &nbsp;&nbsp;<input type="text" name="name" />&nbsp;&nbsp;&nbsp;<input type="submit" value="Login" />
</form>
<?php
}
include ("side.php");
include ("bottom.php");
?>


