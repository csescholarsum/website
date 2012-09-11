<?php

//CREATED BY: jsallans
//DATE: 8-28-12
//CHANGE: new
//PURPOSE: the logged in user will give us the account type and uniqname

session_start();

include('../includes/config.php');
include('../tools/functions.php');
//include( $_SESSION['path'] . 'tools/functions.php');

//$_SERVER['REMOTE_USER'] is the users uniqname returned from cosign with .htaccess

$user = $_SERVER['REMOTE_USER'];
$_SESSION['USER_UNIQ'] = $user;

//MYSQLI database call
$connection = connect_to_db_with_sqli();


//_______________CHECK IF ADMIN________________________

$query = "SELECT type FROM members WHERE uniqname = '$user' AND deleted=0";

$statement = $connection->prepare($query) or die("<p> Database admin validation failed. </p>");

$statement->execute();
$statement->bind_result($type);

if ($statement->fetch()) {

	$_SESSION['type'] = $type;
}

$statement->close();

die(var_dump($_SESSION['type']));

//user is not authorized; redirect to main page
header("Location: https://web.eecs.umich.edu/~cseschol/index.php");
exit();
?>