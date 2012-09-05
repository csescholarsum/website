<?php

$uniqname = $_REQUEST['USER_UNIQ'];

include("../../tools/functions.php");

connect_to_db();

mysql_query("UPDATE FROM members SET deleted=1 WHERE uniqname='$uniqname' AND deleted=0");

?>