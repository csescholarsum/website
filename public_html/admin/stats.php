<?php
$noStats = true;
include("config.php");
include("../functions.php");

if (isset($_POST['clearList']))
{
	mysql_query("DELETE FROM stat");
}

$indirection = "../";
include("./admin_top.php");
include ("../top.php");
include("adminMenu.php"); 
?>
<h3>Website Stats</h3>
<table>
	<tr><th>IP</th><th>&nbsp;</th><th>Name</th><th>&nbsp;</th><th>Time In</th><th>&nbsp;</th><th>Time Out</th><th>&nbsp;</th><th>Duration</th><th>&nbsp;</th><th>Pages</th></tr>
<?php
	$query = mysql_query("SELECT * FROM stat");
	$totalRows = mysql_num_rows($query);
	if ($totalRows == 0)
		echo "\t\t<tr><td>---</td><td>&nbsp;</td><td>---</td><td>&nbsp;</td><td>---</td><td>&nbsp;</td><td>---</td><td>&nbsp;</td><td>---</td><td>&nbsp;</td><td>---</td></tr>\n";
	else
	{
		while ($userData = mysql_fetch_row($query))
		{
			list($id, $sid, $ip, $name, $timein, $timeout, $pages) = $userData;
			if (($pages == 1)&&($name == ""))
				continue;
			$duration = ((int) $timeout) - ((int) $timein);
			date_default_timezone_set('America/Detroit');
			$timein = date(DATE_RFC822, $timein);
			$timeout = date(DATE_RFC822, $timeout);
			$fullName = GetFullName($name);
			if ($fullName != "")
				$name = $fullName;
			echo "\t\t<tr>\n";
			echo "\t\t\t<td>$ip</td><td>&nbsp;</td>\n";
			echo "\t\t\t<td>$name</td><td>&nbsp;</td>\n";
			echo "\t\t\t<td>$timein</td><td>&nbsp;</td>\n";
			echo "\t\t\t<td>$timeout</td><td>&nbsp;</td>\n";
			echo "\t\t\t<td>$duration</td><td>&nbsp;</td>\n";
			echo "\t\t\t<td>$pages</td>\n";
			echo "\t\t</tr>\n";
		}
	}
?>
</table><br /><br />
<?php echo "Total rows: $totalRows<br /><br />\n\n"; ?>
<form action="stats.php" method="post">
	<input type="submit" name="update" value="Update List" />
</form>
<form action="stats.php" method="post">
	<input type="submit" name="clearList" value="Clear List" />
</form>

<?php
include ("../side.php");
include ("../bottom.php");
?>
