<?php
##################################################################################
# U-M CSE Scholars CMS Configuration 
##################################################################################

#
# Required variables for the CMS
#

$cmsver = "v0.1";

$rcwwwpath = '/net/www/u/c/cseschol/public_html/';
$startdate = 'August 31st, 2012';

if (!isset($_SESSION))
{
	session_start();
	session_register();
}


//Set a global path of the server
if (!isset($_SESSION['path'])) {

	if (file_exists($_SERVER['DOCUMENT_ROOT'] . $rcwwwpath . "index.php")) {

		$rcpath = $_SERVER['DOCUMENT_ROOT'] . $rcwwwpath;
		$_SESSION['base_url'] = "http://web.eecs.umich.edu/~cseschol/";
	}
	else if ( file_exists($_SERVER['DOCUMENT_ROOT'] . "cse_scholars_test/public_html/index.php") ) {

		$rcpath = $_SERVER['DOCUMENT_ROOT'] . "cse_scholars_test/public_html/";
		$_SESSION['base_url'] = "http://localhost/cse_scholars_test/public_html/";
	}

	$_SESSION['path'] = $rcpath;
}


####################################
# Database connection information   #
#####################################

$hostname = "localhost";
$database = "csescholars";
$username = "cseschol";
$password = "JAwNuTrJ";


?>
