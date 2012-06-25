<?php
include("config.php");
include("../functions.php");

$p_id = (int) $_GET['id'];

$query = mysql_query("SELECT * FROM polls WHERE id = '$p_id'");

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
		mysql_query("UPDATE polls SET name = '$name', description = '$description', visible = '$visible', open = '$open', write_in = '$writein'
			WHERE id = '$p_id'");
	}
}



$pageTitle = "Admin Section";
$indirection = "../";
include("./admin_top.php");
include ("../top.php");
include("adminMenu.php");

if ($pollExists)
{
echo "<h3>$name Votes</h3>\n\n";
//print votes here

$query = mysql_query("SELECT * FROM votes WHERE uniquename != '' AND poll_id = '$p_id'");

echo "Total Votes: ".mysql_num_rows($query)."<br /><br />\n\n";

if (mysql_num_rows($query) != 0)
{
?>
<table>
	<tr>
    	<td>Unique Name</td>
        <td>&nbsp;</td>
        <td>Vote</td>
    </tr>
<?php
	
	while ($voteData = mysql_fetch_row($query))
	{
		list($vid, $uniqname, $pid, $vote) = $voteData;
		$name = GetFullName($uniqname);
		if ($name != "")
			$uniqname = $name;
		echo "\t<tr>\n";
		echo "\t\t<td>$uniqname</td>\n";
		echo "\t\t<td>&nbsp;</td>\n";
		echo "\t\t<td>$vote</td>\n";
		echo "\t</tr>\n";
	}
	echo "</table>\n\n";
}
}
else
{
	//poll does not exist
	echo "Poll does not exist";
}

include ("../side.php");
include ("../bottom.php");
?>
