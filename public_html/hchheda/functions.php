<?php

function EmailExists($email)
{
	return true;
}

function AddUser($email, $password, $firstname, $lastname, $age, $gender, $city, $state, $country)
{
	return;
}

function UpdateUser($email, $password, $firstname, $lastname, $age, $gender, $city, $state, $country)
{
	return;
}

function SignInValid($email, $password)
{
	return false;
}

function ValidateAlert($name, $time, $date, $recipient, $email, $message)
{
	return true;
}

function AddAlert($name, $time, $date, $recipient, $email, $message)
{
	return;
}

?>
