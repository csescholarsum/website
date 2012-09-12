<?php

$event_id = $_REQUEST['eventID'];

include("../../tools/functions.php");

connect_to_db();

mysql_query("UPDATE events SET deleted=1 WHERE eventID='$event_id' AND deleted=0");

?>