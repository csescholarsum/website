<?php

#####################################
# Database connection information   #
#####################################

$hostname = "localhost";
$database = "csescholars";
$username = "cseschol";
$password = "JAwNuTrJ";
$connection = mysql_pconnect($hostname, $username, $password) or die(mysql_error());

?>