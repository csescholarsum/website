<?php

include("../../tools/functions.php");

connect_to_db();

if (!isset($_REQUEST['poll_id'])) {
	
	echo "Please provide poll id.";
	return;
}

echo PrintPollResults($_REQUEST['poll_id']);

?>