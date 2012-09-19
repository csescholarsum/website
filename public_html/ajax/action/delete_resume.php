<?php

$uniqname = $_REQUEST['USER_UNIQ'];

include("../../tools/functions.php");

DeleteResume($uniqname, "../../resumes/".$uniqname.".pdf");

?>