<?php

include("config.php");
$indirection = "1";
include ("../top.php");include("adminMenu.php"); 
?>
<table>
	<tr>
    	<td>Name</td>
        <td>Email</td>
        <td>Position</td>
    </tr>
<?php
$query = mysql_query("SELECT * FROM admins");

if (mysql_num_rows($query) == 0)
{
?>
	<tr>
    	<td>-</td>
        <td>-</td>
        <td>-</td>
    </tr>
<?php
}
else
{
	while ($userData = mysql_fetch_row($query))
	{
		list($uid, $office_name, $officer_email, $officer_position) = $userData;
		echo "\t<tr>\n";
		echo "\t\t<td>".$office_name."</td>\n";
		echo "\t\t<td>".$officer_email."@umich.edu</td>\n";
		echo "\t\t<td>".$officer_position."</td>\n";
		echo "\t</tr>\n";
	}
}
?>
</table>
<?php
include ("../side.php");
include ("../bottom.php");
?>
