<?php
include ("functions.php");
include("dbConnect.php");
$curPage="polls";
include("top.php"); 
?>

<h3>&nbsp;Open Polls</h3>

<?php
$query = mysql_query("SELECT * FROM polls");

if (mysql_num_rows($query) == 0)
{
	echo "There are no open polls at this time.\n\n";
}
else
{
?>
<table>
	<tr>
    	<td>Name</td>
        <td>&nbsp;&nbsp;&nbsp;</td>
        <td>Voting Open</td>
    </tr>
<?php
	while ($pollData = mysql_fetch_row($query))
	{
		list($pid, $poll_name, $description, $visible, $open, $writein) = $pollData;
		if (!$visible)
			continue;
		if ($open)
			$open = "Open";
		else
			$open = "Closed";
		if ($poll_name == "")
			$poll_name = "No Name";
		echo "\t<tr>\n";
		echo "\t\t<td><a href=\"https://web.eecs.umich.edu/~cseschol/members/viewpoll.php?id=$pid\">".$poll_name."</a></td>\n";
		echo "\t\t<td>&nbsp;&nbsp;&nbsp;</td>\n";
		echo "\t\t<td>".$open."</td>\n";
		echo "\t</tr>\n";
	}
}
?>
</table>

<?php
include ("side.php");
include("bottom.php");
?>

