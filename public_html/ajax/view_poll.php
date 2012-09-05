<?php

/*
CREATED BY: jsallans
DATE: 8-30-12
CHANGED: new
PURPOSE: returns the page for the given
 poll showing results and giving voting options

*/

include("../tools/functions.php");

$user = $_REQUEST['USER_UNIQ'];

$pid = (int) $_REQUEST['id'];

connect_to_db();

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

//Get poll data
$query = mysql_query("SELECT * FROM polls WHERE id = '$pid'");
if (mysql_num_rows($query) == 0)
{
	die("no matching poll");
}

$pollData = mysql_fetch_row($query);
list($pid, $name, $description, $visible, $open, $writein) = $pollData;

//Get previous voted info
$query = mysql_query("SELECT vote FROM votes WHERE poll_id = '$pid' AND uniqname = '$user'");
$alreadyVoted = (mysql_num_rows($query) != 0);
$voteData = mysql_fetch_row($query);
$my_vote = $voteData[0];	

echo "<div style='float: left; width: 300px;'>";

//Print name of poll
echo "<h3>$name</h3>\n";

if ($description != "")
	echo $description."<br /><br />\n";
if ($open)
{
	if ($invalidWritein)
		echo "Writein votes are not allowed. Please select one of the options instead.<br /><br />\n\n";
	if ($alreadyVoted)
		echo "You voted for: $my_vote<br /><br />\n\nChange your vote: <br /><br />\n";
	else
		echo "Place your vote: <br /><br />\n";
?>
<form class="voteForm" name="voteForm" method="post">

<input type="hidden" name="USER_UNIQ" value="<?php echo $_REQUEST['USER_UNIQ'];?>">
<input type="hidden" class="poll_id" name="poll_id" value="<?php echo $_REQUEST['id']; ?>">
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

					$select_html = "";
					if ($vote == $my_vote) {
						$select_html = "selected";
					}

					echo "\t\t\t\t\t<option value=\"$vote\" $select_html>$vote</option>\n";
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
        <td><input id="writein" type="text" name="vote" value="<?php echo $my_vote; ?>"/></td>
    </tr>
    <?php
	}
	?>
</table>
</form>
<?php
}
else
{
	echo "Voting is closed<br /><br />";
}

echo <<<string
	</div>
	<div style='float: right;'>
		<h3>Polling Results:</h3>
		<div class='poll_results'>
string;
echo PrintPollResults($pid);
echo <<<string
		</div>
	</div>
string;

?>