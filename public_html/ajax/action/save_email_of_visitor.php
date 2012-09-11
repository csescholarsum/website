<?php

/*
CREATED BY: jsallans
DATE: 8-28-12
CHANGE: new
PURPOSE: to validate an email and save it into the database
*/

	include("../../includes/config.php");
	include("../../tools/functions.php");

	$conn = connect_to_db_with_sqli();

	//Check if email is provided
	if (!isset($_REQUEST['email'])) {

		echo "No email provided";
		return;
	}

	$email = $_REQUEST['email'];

	//Check if email is valid
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

		echo "Email: $email is NOT valid.";
		return;
	}

	$query = "INSERT INTO member_list_views (`email`) VALUES (?)";

	$statement = $conn->prepare($query) or die("Failed to submit email to database.");
	$statement->bind_param('s', $email);
	$statement->execute();
	$statement->close();

	echo "Email successfully submitted.";

	//Save email for future uses
	setcookie("email", $email, time()+3600*24*30, '/');  /* expire in 1 month */

?>