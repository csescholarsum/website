<?php  

$sub = "Main Page";
include 'monitor.php';

$registrationError = false;
$emailNotUnique = false;
if (isset($_POST['register']))
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
		$registrationError = true;
	if (($firstname == "")||($lastname == ""))
		$registrationError = true;
	if (!$registrationError)
	{
		//data valid; check if email is unique
		$emailNotUnique = true;
	}
}

?>

<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="main_page_style.css" rel="stylesheet" type="text/css">
<title>Page title here</title>

<script type="text/javascript">

var validColor = "white";
var errorColor = "red";

function FormValidation(formPtr)
{
	var formError = false;
	if (formPtr.email.value == "")
	{
		formPtr.email.style.background = errorColor;
		formError = true;
	}
	else
		formPtr.email.style.background = validColor;
	if ((formPtr.password.value == "")||(formPtr.password.value != formPtr.password2.value))
	{
		formPtr.password.style.background = errorColor;
		formPtr.password2.style.background = errorColor;
		formPtr.password.value = "";
		formPtr.password2.value = "";
		formError = true;
	}
	else
	{
		formPtr.password.style.background = validColor;
		formPtr.password2.style.background = validColor;
	}
	if (formPtr.firstname.value == "")
	{
		formPtr.firstname.style.background = errorColor;
		formError = true;
	}
	else
		formPtr.firstname.style.background = validColor;
	if (formPtr.lastname.value == "")
	{
		formPtr.lastname.style.background = errorColor;
		formError = true;
	}
	else
		formPtr.lastname.style.background = validColor;
	if (formError)
	{
		document.getElementById('errorDiv').style.display = "block";
		return false;
	}
	return true;
}

</script>

</head>

<body>

<div id="main">

	<div id="signin">
		Already have an account? &nbsp;&nbsp;&nbsp;
		<span id="signinButton">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sign In&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</span>
	</div>
	<div id="header">Text Text Text</div>
	<div id ="body">
		<div id="video"><span style="vertical-align: middle">Video Here</span></div>
		<div id="signup">
			<h3>Join us for free</h3>
			<div id="errorDiv">Error: Please fix marked fields before submitting</div>
			<?php

			if ($emailNotUnique)
			{
				echo "<div style=\"color: red;\">";
				echo "Error: Email is already in use";
				echo "</div>";
			}

			?>
			<form id="signupForm" action="main.php" method="post" >
			<table>
			<tr>
				<td>Email address:</td>
				<td><input type="text" name="email" value="<?php echo $email; ?>" /></td>
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
				<td><input type="text" name="firstname" value="<?php echo $firstname; ?>" /></td>
			</tr>
			<tr>
				<td>Last Name:</td>
				<td><input type="text" name="lastname" value="<?php echo $lastname; ?>" /></td>
			</tr>
			<tr>
				<td>Age (optional):</td>
				<td><input type="text" name="age" value="<?php echo $age; ?>" /></td>
			</tr>
			<tr>
				<td>Gender (optional):</td>
				<td><input type="text" name="gender" value="<?php echo $gender; ?>" /></td>
			</tr>
			<tr>
				<td>City (optional):</td>
				<td><input type="text" name="city" value="<?php echo $city; ?>" /></td>
			</tr>
			<tr>
				<td>State (optional):</td>
				<td><input type="text" name="state" value="<?php echo $state; ?>" /></td>
			</tr>
			<tr>
				<td>Country (optional):</td>
				<td><input type="text" name="country" value="<?php echo $country; ?>" /></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input style="background-color: #000066; color: white; border: 0;" type="submit" name="register" value="Register" /></td>
			</tr>
			</table>
			</form>

		</div>
	</div>
	<div id="footer">Footer Text Here</div>
</div>

</body>
</html>

