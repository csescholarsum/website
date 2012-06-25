<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Testing</title>
</head>
<body>
<?php
if (isset($_SESSION['loggedin']))
	$loggedin = $_SESSION['loggedin'];
else
	$loggedin = false;
if (isset($_POST['user']))
{
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	if (($user != "Jim")||($pass != "pwd"))
		$loginfail = true;
	else
	{
		$loggedin = true;
		$_SESSION['loggedin'] = true;
	}
}

if (!$loggedin)
{

	if ($loginfail)
		echo "Login failed. Try again<br />\n";
?>
<form action="test.php" method="post">
	<input name="user" type="text" value="" /> <br />
    <input name="pass" type="text" value="" /><br />
    <input type="submit" value="enter" />
</form>
<?php
}
else
{
	echo "You are logged in as ".$user;
}
?>
</body>
</html>