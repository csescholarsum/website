<?php

function connect_to_db() {
	####################################
	# Database connection information   #
	#####################################

	$hostname = "localhost";
	$database = "csescholars";
	$username = "cseschol";
	$password = "JAwNuTrJ";

	$db = mysql_connect($hostname, $username, $password);
	if (!$db)
	{
		echo '<p>Error connecting to database!</p>';
		exit;
	}
	mysql_select_db($database, $db);

	return $db;
}


//Created by: jsallans
//Date: 8-28-12
//Change: new
//Purpose: to make data base connections easier

function connect_to_db_with_sqli() {
	####################################
	# Database connection information   #
	#####################################

	$hostname = "localhost";
	$database = "csescholars";
	$username = "cseschol";
	$password = "JAwNuTrJ";

	$conn = new mysqli($hostname, $username, $password, $database) or die("<p> Error connecting to database. </p>");

	return $conn;
}

//PURPOSE: will check if the file is a PDF then uploads it
function AddResume($temp_files, $uniqname) {

	//$temp_files is passed as $_FILES

	DeleteResume($uniqname);

	//check if file ends with ".pdf"
	if (substr_compare($temp_files['resumeFile']['name'], ".pdf", -4) === 0)
	{

		if (move_uploaded_file($temp_files['resumeFile']['tmp_name'], $_SESSION['path'] . "resumes/".$uniqname.".pdf")) {

			//Mark resume exists
			connect_to_db();
			mysql_query("UPDATE members SET hasResume = '1' WHERE uniqname = '$uniqname' AND deleted=0");

			echo "Resume successfuly uploaded.";
		}
		else {

			echo "File didn't upload.";
		}
	}
	else
	{
		echo "Resume needs to be a .pdf";
	}

}


//______________Before Jeff_________________________


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
	$path = $_SESSION['path'] . "resumes/".$uniqname.".pdf";
	if (file_exists($path))
		unlink($path); //remove

	//Unmark resume exists
	connect_to_db();
	mysql_query("UPDATE members SET hasResume = '0' WHERE uniqname = '$uniqname' AND deleted=0");

}

function PrintPollResults($pid)
{
	//print votes in decending order here
	$totalVotes = 0;
	$html = "<table>\n";
	$query = mysql_query("SELECT vote, count(vote) as Frequency from votes WHERE uniqname != '' AND poll_id = '$pid' GROUP BY vote ORDER BY Frequency DESC");
	while ($voteData = mysql_fetch_row($query))
	{
			$html .= "\t<tr><td>".stripslashes(stripslashes($voteData[0])).": </td><td>&nbsp;";
			$numVotes = $voteData[1];
			$totalVotes += $numVotes;
			$html .= $numVotes."</td></tr>\n";
	}
	$html .= "\t<tr><td>&nbsp;</td><td>&nbsp;</td></tr>\n";
	$html .= "\t<tr><td>Total Votes: </td><td>&nbsp;$totalVotes</td></tr>\n";
	$html .= "</table>\n\n";

	return $html;

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

function PrintGPA($gpa)
{
	if ($gpa != 0)
	{
		echo $gpa;
		if (strlen($gpa) == 1)
			echo ".00";
		if (strlen($gpa) == 3)
			echo "0";
	}
}

?>
