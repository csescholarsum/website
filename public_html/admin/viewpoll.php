<?php
include("config.php");
include("../functions.php");

$pid = (int) $_GET['id'];

$query = mysql_query("SELECT * FROM polls WHERE id = '$pid'");

if (mysql_num_rows($query) == 0)
{
	//no poll exists
	$pollExists = false;
}
else
{
	$pollExists = true;

	$pollData = mysql_fetch_row($query);
	
	list($id, $name, $description, $visible, $open, $writein) = $pollData;
	
	if (isset($_POST['name']))
	{
		//poll update; error detection/correction needed
		$name = mysql_real_escape_string($_POST['name']);
		$description = mysql_real_escape_string($_POST['description']);
		if ($_POST['pollVisible'] == "on")
			$visible = 1;
		else
			$visible = 0;
		if ($_POST['votingOpen'] == "on")
			$open = 1;
		else
			$open = 0;
		if ($_POST['writein'] == "on")
			$writein = 1;
		else
			$writein = 0;
		mysql_query("UPDATE polls SET name = '$name', description = '$description', visible = '$visible', open = '$open', write_in = '$writein' WHERE id = '$pid'");
	}
	if (isset($_POST['addVote']))
	{
		$vote = mysql_real_escape_string($_POST['vote']);
		mysql_query("INSERT INTO votes (uniquename, poll_id, vote) VALUES ('', '$pid', '$vote')");
	}
}



$pageTitle = "Admin Section";
$indirection = "../";
include("./admin_top.php");
include ("../top.php");
include("adminMenu.php");

if ($pollExists)
{
?>
<h3>Edit Poll</h3>
<form name="updatePoll" method="post" action="viewpoll.php?id=<?php echo $pid; ?>">
    <table>
    <tr><td>Name: </td><td><input name="name" type="text" value="<?php echo $name; ?>" /></td></tr>
    <tr><td>Description: </td><td><textarea name="description" cols="20" rows="2"><?php echo $description; ?></textarea></td></tr>
    <tr><td>Poll Visible: </td><td><input name="pollVisible" type="checkbox" <?php if ($visible) echo "checked=\"checked\""; ?> /></td></tr>
    <tr><td>Voting Open: </td><td><input name="votingOpen" type="checkbox" <?php if ($open) echo "checked=\"checked\""; ?> /></td></tr>
    <tr><td>Allow Write-in: </td><td><input name="writein" type="checkbox" <?php if ($writein) echo "checked=\"checked\""; ?> /></td></tr>
    <tr><td>&nbsp;</td><td><input type="submit" name="updatePoll" value="Update Poll" /></td></tr>
    </table>
</form>
Add an option for voting. This will appear on the voting page as something users can vote for.
<form name="addVoteForm" method="post" action="viewpoll.php?id=<?php echo $pid; ?>">
	Add Vote Option: <input type="text" name="vote" /> &nbsp; <input type="submit" name="addVote" value="Add" />    
</form>
<br />
<form name="deletePollForm" action="polls.php?delete=<?php echo $pid; ?>" method="post">
<input type="submit" name="deletePoll" value="Delete Poll" />
</form><br />

<?php
//print votes here
PrintPollResults($pid);
echo "\n\n<br /><br /><a href=\"viewvotes.php?id=$pid\">View Votes</a>";
}
else
{
	//poll does not exist
	echo "Poll does not exist";
}

include ("../side.php");
include ("../bottom.php");
?>
