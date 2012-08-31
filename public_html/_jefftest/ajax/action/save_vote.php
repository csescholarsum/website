<?php

include("../../tools/functions.php");

connect_to_db();

//Check if USER_UNIQ is null
if (!isset($_REQUEST['USER_UNIQ'])) {

	echo "Please provide the users uniqname.";
	return;
}

$user = $_REQUEST['USER_UNIQ'];
$vote = mysql_real_escape_string($_POST['vote']);
$vote = strip_tags($vote);
$pid = strip_tags($_POST['poll_id']);


$query = mysql_query("SELECT * FROM polls WHERE id = '$pid'");
if (mysql_num_rows($query) == 0)
{
	die("no matching poll");
}

$pollData = mysql_fetch_row($query);
list($pid, $name, $description, $visible, $open, $writein) = $pollData;

if (!$visible)
	$pollExists = false;
else
{

	$invalidWritein = false;
	//check if user has already voted in this poll
	$query = mysql_query("SELECT vote FROM votes WHERE poll_id = '$pid' AND uniqname = '$user'");
	$alreadyVoted = (mysql_num_rows($query) != 0);
	
	if ($open)
	{
		if ((!$writein)&&($vote != ""))
		{
			//check if this vote is a write in
			$query = mysql_query("SELECT * FROM votes WHERE poll_id = '$pid' AND vote = '$vote'");
			if (mysql_num_rows($query) == 0)
			{
				//this is a write in, not allowed
				$invalidWritein = true;
				$vote = $voteData[0];
			}
		}
		if ( ($vote != "") && (!$invalidWritein) )
		{
			//check if user has already voted; if so, update it
			if ($alreadyVoted)
			{
				mysql_query("UPDATE votes SET vote = '$vote' WHERE poll_id = '$pid' AND uniqname = '$user' LIMIT 1");
			}
			else
			{
				mysql_query("INSERT INTO votes (uniqname, poll_id, vote) VALUES ('$user', '$pid', '$vote')");
			}
		}
	}
}


echo "Vote successfully submitted.";

?>