<?php

	include("../includes/config.php");
	include("../tools/functions.php");

	connect_to_db();
?>

<table class='data_table' cellspacing="4" style="width: 100%">
    	<th>Name</th>
        <th>Email</th>
        <th>Major</th>
        <th>Graduation</th>
<?php
$query = mysql_query("SELECT * FROM members WHERE type='Alumni' AND deleted=0 ORDER BY name");

#checks if db doesn't open
if (mysql_num_rows($query) == 0)
{
?>
	<tr>
    	<td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
    </tr>
<?php
}
else
{
	
	#This indexes through the db to print member info
	
	while ($userData = mysql_fetch_row($query))
	{
		list($id, $deleted, $name, $uniqname, $gradMonth, $gradYear, $showResume, $hasResume, $major, $hidden, $gpa, $type) = $userData;
		if ($name == "")
			$name = "No Name";
		$member_email = $uniqname."@umich.edu";
		
		#printing info into table
		echo "\t<tr>\n";
		echo "\t\t<td>$name</td>\n";
		echo "\t\t<td>".$member_email."</td>\n";
		echo "\t\t<td>".$major."</td>\n";
		if (($gradMonth < 1)||($gradMonth > 12))
			echo "\t\t<td>&nbsp;</td>\n";
		else
			echo "\t\t<td>".$gradMonth."/".$gradYear."</td>\n";
		echo "</td>\n";
		echo "\t</tr>\n";
	}
}

#close database

?>
</table>