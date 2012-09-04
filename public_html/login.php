<?php

//CREATED BY: jsallans
//DATE: 8-28-12
//CHANGE: new
//PURPOSE: redirect logged in user to appropriate site

session_start();

include('../includes/config.php');
include( $_SESSION['path'] . 'tools/functions.php');

//$_SERVER['REMOTE_USER'] is the users uniqname returned from cosign with .htaccess

$user = $_SERVER['REMOTE_USER'];
$_SESSION['USER_UNIQ'] = $user;

//MYSQLI database call
$connection = connect_to_db_with_sqli();


//_______________CHECK IF ADMIN________________________

$query = "SELECT * FROM members WHERE uniqname = '$user' AND type = 'Admin'";

$statement = $connection->prepare($query) or die("<p> Database admin validation failed. </p>");

$statement->execute();

//Check if there is an admin entry
if ($statement->num_rows != 0)
{
	//user is an admin; redirect to main page
	header("Location: " . $_SESSION['base_url'] . "admin/index.php");
	exit();
}

$statement->close();


//_______________CHECK IF MEMBER________________________

$query = "SELECT * FROM members WHERE uniqname = '$user' AND type = 'Member'";

$statement = $connection->prepare($query) or die("<p> Database admin validation failed. </p>");

$statement->execute();

//Check if there is a member entry
if ($statement->num_rows != 0)
{
	//user is a member; redirect to main page
	header("Location: " . $_SESSION['base_url'] . "member/index.php");
	exit();
}

$statement->close();


//user is not authorized; redirect to main page
header("Location: " . $_SESSION['base_url'] . "index.php");
exit();
?>