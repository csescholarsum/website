<?php 

include("config.php");
include("../functions.php");

if (isset($_POST['addPoll']))
{
	//adding a new Poll
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
	mysql_query("INSERT INTO polls (name, description, visible, open, write_in)
		VALUES ('$name', '$description', '$visible', '$open', '$writein')");
}

if (isset($_GET['delete']))
{
	$poll_id = $_GET['delete'];
	mysql_query("DELETE FROM polls WHERE id = '$poll_id' LIMIT 1");
	//remove votes here
	mysql_query("DELETE FROM votes WHERE poll_id = '$poll_id'");
}
//$pageTitle = "Admin Section";
$includeStyle = "pollStyle.php";
$indirection = "../";
include("./admin_top.php");
include ("../top.php");
include("adminMenu.php"); 
?>
<div onclick="addPollClick();" onmouseover="addPollOver(this);" onmouseout="addPollOut(this);" style="color: white; font-weight: bold; display: inline" id="addPollButton">Add Poll</div><br />
<br />
<div id ="addPollSection">
<form enctype="multipart/form-data" name="addPollForm" method="post" action="polls.php">
    <table>
    <tr><td>Name: </td><td><input name="name" type="text" /></td></tr>
    <tr><td>Description: </td><td><textarea name="description" cols="20" rows="2"></textarea></td></tr>
    <tr><td>Poll Visible: </td><td><input name="pollVisible" type="checkbox" checked="checked" /></td></tr>
    <tr><td>Voting Open: </td><td><input name="votingOpen" type="checkbox" checked="checked" /></td></tr>
    <tr><td>Allow Write-in: </td><td><input name="writein" type="checkbox" checked="checked" /></td></tr>
    <tr><td>&nbsp;</td><td><input type="submit" name="addPoll" value="Add Poll" /></td></tr>
    </table>
</form>
</div>
<table>
	<tr>
		<td>&nbsp;</td>
    	<td>Name</td>
        <td>Description</td>
        <td>Poll Visible</td>
        <td>Voting Open</td>
        <td>Write-in Allowed</td>
    </tr>
<?php
$query = mysql_query("SELECT * FROM polls");

if (mysql_num_rows($query) == 0)
{
?>
	<tr>
    	<td>&nbsp;</td>
    	<td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
    </tr>
<?php
}
else
{
	while ($pollData = mysql_fetch_row($query))
	{
		list($pid, $poll_name, $description, $visible, $open, $writein) = $pollData;
		if ($visible)
			$visible = "Visible";
		else
			$visible = "Hidden";
		if ($open)
			$open = "Open";
		else
			$open = "Closed";
		if ($writein)
			$writein = "Allowed";
		else
			$writein = "Forbidden";
		if ($poll_name == "")
			$poll_name = "No Name";
		if (strlen($description) > 12)
			$description = substr($description, 0, 12)."...";
		echo "\t<tr>\n";
		echo "\t\t<td id=\"deleteStyle\" onMouseOut=\"this.style.cursor = 'auto';\" onMouseOver=\"this.style.cursor = 'pointer';\" onclick=\"window.location='polls.php?delete=$pid'\">X</td>\n";
		echo "\t\t<td><a href=\"viewpoll.php?id=$pid\">".$poll_name."</a></td>\n";
		echo "\t\t<td>$description</td>\n";
		echo "\t\t<td>".$visible."</td>\n";
		echo "\t\t<td>".$open."</td>\n";
		echo "\t\t<td>".$writein."</td>\n";
		echo "\t</tr>\n";
	}
}
?>
</table>

          
<?php
include ("../side.php");
include ("../bottom.php");
?>


