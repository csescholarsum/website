<?php

#####################################
# Database connection information   #
#####################################

$hostname = "localhost";
$database = "csescholars";
$username = "cseschol";
$password = "JAwNuTrJ";
$includesDB = true;
$connection = mysql_pconnect($hostname, $username, $password) or die(mysql_error());

?>