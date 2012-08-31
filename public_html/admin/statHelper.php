<?php

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
if(!isset($_SESSION))
	session_start();
if(!$includesDB)
{
	//connect to db
	$db_hostname = "localhost";
	$db_database = "csescholars";
	$db_username = "cseschol";
	$db_password = "JAwNuTrJ";
	$cmsver = "v0.1";

	$rcwwwpath = '/net/www/u/c/cseschol/public_html/';
	$startdate = 'October 19th, 2007';
	
	$rcpath = $_SERVER['DOCUMENT_ROOT'] . $rcwwwpath;
	$filepath = '/var/www/html/';
	$sqluser = "cseschol";
	$sqlpass = "JAwNuTrJ";
	$sqldb = "csescholars";
	$db = mysql_pconnect($db_hostname, $db_username, $db_password) or die(mysql_error());
	if (!$db)
	{
		echo '<p>Error connecting to database!</p>';
		exit;
	}
	mysql_select_db($sqldb, $db);
}

$sid = session_id();
$ip=getRealIpAddr();
$stat_time=time();
$stat_user=$_SESSION['USER_UNIQ'];
if ($stat_user == "")
{
	if ($_SESSION['recruiter'] == "LOGGED_IN")
		$stat_user = "recruiter";
}


$query_DB = mysql_query("SELECT uniquename, pages FROM stat WHERE session_id = '$sid'");
if (mysql_num_rows($query_DB) == 0)
{
	//create row for this user
	mysql_query("INSERT INTO stat (session_id, ip, uniquename, time_in, time_out, pages)
		VALUES ('$sid', '$ip', '$stat_user', '$stat_time', '$stat_time', '1')");
}
else
{
	//update time_out
	$nameArray = mysql_fetch_row($query_DB);
	$stat_name = $nameArray[0];
	$pageCount = $nameArray[1];
	if ($stat_name == "")
		$stat_name = $stat_user;
	$pageCount++;
	mysql_query("UPDATE stat SET time_out = '$stat_time', uniquename = '$stat_name', pages = '$pageCount' WHERE session_id = '$sid'");
}
?>
