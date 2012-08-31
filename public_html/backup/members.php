<?php
include ("functions.php");
include("dbConnect.php");
$curPage="members";
include("top.php"); 
?>

<h3>&nbsp;CSE Scholars Winter 2011</h3>

<table>
	<tr><th>Name</th><th>Major</th><th>Graduation</th></tr>
<?php
	$query = mysql_query("SELECT * FROM members");
	if (mysql_num_rows($query) == 0)
		echo "\t\t<tr><td>---</td><td>---</td><td>---</td></tr>\n";
	else
	{
		while ($userData = mysql_fetch_row($query))
		{
			list($uid, $member_name, $uniqname, $gradMonth, $gradYear, $showResume, $hasResume, $major) = $userData;
			if ($member_name == "")
				continue;
			echo "\t\t<tr>\n";
			echo "\t\t\t<td>$member_name</td>\n";
			echo "\t\t\t<td>$major</td>\n";
			echo "\t\t\t<td>".FormatGradDate($gradMonth, $gradYear)."</td>\n";
			echo "\t\t</tr>\n";
		}
	}
?>
</table>

<?php
include ("side.php");
include("bottom.php");
?>