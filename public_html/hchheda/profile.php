<?php

$sub = "Profile Page";
include 'monitor.php';

if (isset($_POST['updateProfile']))
{
	//user is registering
	$email = $_POST['email'];
	$password = $_POST['password'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$age = $_POST['age'];
	$gender = $_POST['gender'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$country = $_POST['country'];
	if (($email == "")||($password == "")||($password != $_POST['password2']))
		$updateError = true;
	if (($firstname == "")||($lastname == ""))
		$updateError = true;
	if (!$updateError)
	{
		//data valid; update user
		UpdateUser($email, $password, $firstname, $lastname, $age, $gender, $city, $state, $country);
	}
}

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="profile_page_style.css" rel="stylesheet" type="text/css">
<title>Page title here</title>
</head>

<body>

<div id="main">

	<div id ="body">
		<div id="profile">
			<h3>Your Profile</h3>
			<form id="signupForm" method="post">
			<table>
			<tr>
				<td>Email address:</td>
				<td><input type="text" name="email" /></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="password" name="password" /></td>
			</tr>
			<tr>
				<td>Re-type password:</td>
				<td><input type="password" name="password2" /></td>
			</tr>
			<tr>
				<td>First Name:</td>
				<td><input type="text" name="firstname" /></td>
			</tr>
			<tr>
				<td>Last Name:</td>
				<td><input type="text" name="lastname" /></td>
			</tr>
			<tr>
				<td>Age (optional):</td>
				<td><input type="text" name="age" /></td>
			</tr>
			<tr>
				<td>Gender (optional):</td>
				<td><input type="text" name="gender" /></td>
			</tr>
			<tr>
				<td>City (optional):</td>
				<td><input type="text" name="city" /></td>
			</tr>
			<tr>
				<td>State (optional):</td>
				<td><input type="text" name="state" /></td>
			</tr>
			<tr>
				<td>Country (optional):</td>
				<td><input type="text" name="country" /></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input style="background-color: #000066; color: white; border: 0;" type="submit" name="updateProfile" value="Save" /></td>
			</tr>
			</table>
			</form>

		</div>
	</div>
	<div id="footer"><?php include("footer.php"); ?></div>
</div>

</body>
</html>

