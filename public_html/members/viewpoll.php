<?php

session_start();
require_once ('../connections/connection.php');
include ("../includes/config.php"); # config file with variables (required)
include("../includes/admin.php");
include("../functions.php");

$db = mysql_connect("localhost", $sqluser, $sqlpass);
if (!$db)
{
	echo '<p>Error connecting to database!</p>';
	exit;
}
mysql_select_db($sqldb, $db);

$user = $_SERVER['REMOTE_USER'];
$_SESSION['USER_UNIQ'] = $user;

if ($user == "")
{
	header("Location: ../polls.php");
	exit();
}

$pid = (int) $_GET['id'];

//user does not need to be a member to vote in polls
/*$query = mysql_query("SELECT * FROM members WHERE uniquename = '$user'");

if (mysql_num_rows($query) == 0)
{
	//user is not authorized; redirect to main page
	header("Location: ../index.php");
	exit();
}

$userData = mysql_fetch_row($query);

list($id, $name, $uniqname, $gradMonth, $gradYear, $showResume, $hasResume, $major, $hidden) = $userData; */

$query = mysql_query("SELECT * FROM polls WHERE id = '$pid'");
if (mysql_num_rows($query) == 0)
{
	//no matching poll
	$pollExists = false;
}
else
{
	$pollExists = true;
	$pollData = mysql_fetch_row($query);
	list($pid, $name, $description, $visible, $open, $writein) = $pollData;
	if (!$visible)
		$pollExists = false;
	else
	{
		$invalidWritein = false;
		//check if user has already voted in this poll
		$query = mysql_query("SELECT vote FROM votes WHERE poll_id = '$pid' AND uniquename = '$user'");
		$alreadyVoted = (mysql_num_rows($query) != 0);
		$voteData = mysql_fetch_row($query);
		$vote = $voteData[0];
		if ((isset($_POST['voteSubmit']))&&$open)
		{
			$vote = mysql_real_escape_string($_POST['vote']);
			$vote = strip_tags($vote);
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
			if (($vote != "")&&(!$invalidWritein))
			{
				//check if user has already voted; if so, update it
				if ($alreadyVoted)
				{
					mysql_query("UPDATE votes SET vote = '$vote' WHERE poll_id = '$pid' AND uniquename = '$user' LIMIT 1");
				}
				else
				{
					mysql_query("INSERT INTO votes (uniquename, poll_id, vote) VALUES ('$user', '$pid', '$vote')");
					$alreadyVoted = true;
				}
			}
			if ($vote == "")
				$vote = $voteData[0];
		}
	}
}

$pageTitle = $name;
$indirection = "../";
$curPage="polls";
include ("../top.php");
if ($pollExists)
{
	echo "<h3>&nbsp;$name</h3>\n\n";
	if ($description != "")
		echo $description."<br /><br /><br />\n\n";
	if ($open)
	{
		if ($invalidWritein)
			echo "Writein votes are not allowed. Please select one of the options instead.<br /><br />\n\n";
		if ($alreadyVoted)
			echo "You voted for: $vote<br /><br />\n\nChange your vote: <br /><br />\n";
		else
			echo "Place your vote: <br /><br />\n";
	?>
    <form name="voteForm" method="post" action="viewpoll.php?id=<?php echo $pid; ?>">
    <table>
    	<tr>
    		<td>Select Choice: </td>
            <td>
            	<select <?php if ($writein) echo "onchange=\"document.getElementById('writein').value = this.value;\" name=\"predefinedOption\""; else echo "name = \"vote\""; ?>>
                	<option value=""></option>
                    <?php
					$query = mysql_query("SELECT vote FROM votes WHERE poll_id = '$pid' GROUP BY vote");

					//print votes in decending order here
					$totalVotes = mysql_num_rows($query);
					while ($voteData = mysql_fetch_row($query))
					{
						$vote = stripslashes(stripslashes($voteData[0]));
						echo "\t\t\t\t\t<option value=\"$vote\">$vote</option>\n";
					}
					?>
        		</select>
            </td>
        </tr>
        <?php
		if ($writein)
		{
		?>
        <tr>
        	<td>Write-in: </td>
            <td><input id="writein" type="text" name="vote" /></td>
        </tr>
        <?php
		}
		?>
        <tr>
        	<td>&nbsp;</td>
            <td><input type="submit" name="voteSubmit" value = "Vote" /></td>
        </tr>
    </table>
    </form>
    <?php
	}
	else
	{
		echo "Voting is closed<br /><br />";
	}
	echo "<br /><h3>Polling Results:</h3>";
	PrintPollResults($pid);
}
else
{
	echo "<h3>&nbsp;Poll Does Not Exist</h3>\n\n";
}
include ("../side.php");
include ("../bottom.php");
?>
