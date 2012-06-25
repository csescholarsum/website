<?php

#####################################
# Database connection information   #
#####################################


//Note: DB login information has been removed
$hostname = "";
$database = "";
$username = "";
$password = "";
$includesDB = true;
$connection = mysql_pconnect($hostname, $username, $password) or die(mysql_error());

?>
