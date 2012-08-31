<?php

function FormatGradDate($gradMonth, $gradYear)
{
	if (($gradMonth < 1)||($gradMonth > 12))
	{
		if ($gradYear < 2000)
			return "";
		else
			return $gradYear;
	}
	if ($gradYear < 2000)
		return date( 'F', mktime(0, 0, 0, $gradMonth));
	return date( 'F', mktime(0, 0, 0, $gradMonth)).", ".$gradYear;
}

function DeleteResume($uniqname)
{
	$path = "../resumes/".$uniqname.".pdf";
	if (file_exists($path))
		unlink($path); //remove cover
	$path = "../".$path;
	if (file_exists($path))
		unlink($path); //remove real
}

function PrintPollResults($pid)
{
	//print votes in decending order here
	$totalVotes = 0;
	echo "<table>\n";
	$query = mysql_query("SELECT vote, count(vote) as Frequency from votes WHERE uniquename != '' AND poll_id = '$pid' GROUP BY vote ORDER BY Frequency DESC");
	while ($voteData = mysql_fetch_row($query))
	{
			echo "\t<tr><td>".$voteData[0].": </td><td>&nbsp;";
			$numVotes = $voteData[1];
			$totalVotes += $numVotes;
			echo $numVotes."</td></tr>\n";
	}
	echo "\t<tr><td>&nbsp;</td><td>&nbsp;</td></tr>\n";
	echo "\t<tr><td>Total Votes: </td><td>&nbsp;$totalVotes</td></tr>\n";
	echo "</table>\n\n";
}

//returns full name of member
//assumes db is set
function GetFullName($uniquename)
{
	$query = mysql_query("SELECT name FROM members WHERE uniquename = '$uniquename' LIMIT 1");
	if (mysql_num_rows($query) == 0)
		return "";
	$name = mysql_fetch_row($query);
	return stripslashes($name[0]);
}
?>
