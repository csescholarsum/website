<?php

	include("../includes/config.php");
	include("../tools/functions.php");

	connect_to_db();
?>

<table cellspacing="4" style="width: 100%">
    <th>Name</th>
    <th>Uniqname</th>
	<th>Events Attended</th>
	<th>Service Hours</th>
<?php
$query = mysql_query("
SELECT 
    a.name, 
    a.uniqname, 
    COUNT( * )
FROM 
    attendies a,
    events e
WHERE 
    a.deleted =0
    AND e.eventID = a.eventID
    AND e.SerHours = 0
    AND e.deleted =0
    AND (
        a.uniqname
    ) NOT
    IN (
        SELECT uniqname
        FROM members
        WHERE deleted =0
    )
GROUP BY a.uniqname
ORDER BY a.uniqname
");

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
	$old_uniqname = "";
	while ($userData = mysql_fetch_row($query))
	{

        list($name, $uniqname, $numEvents) = $userData;
        $serv_query = mysql_query("
            SELECT 
                SUM( e.SerHours )
            FROM 
                attendies a,
                events e
            WHERE 
                a.deleted =0
                AND a.uniqname = '". $uniqname ."'
                AND e.eventID = a.eventID
                AND e.deleted =0
            GROUP BY a.uniqname
            ORDER BY a.uniqname
        ");
        $servData = mysql_fetch_row($serv_query);
        list($numService) = $servData;
		
        #fix to avoid having 0 service hours
        if ($numService == 0) {
          $numService = "-";
        }

        if ($numEvents == 0) {
          $numEvents = "-";
        }
    		
        #printing info into table
        echo "\t<tr>\n";
        echo "\t\t<td>$name</td>\n";
    	echo "\t\t<td>$uniqname</td>\n";
        echo "\t\t<td style=\"text-align:center;\">".$numEvents."</td>\n";
        echo "\t\t<td style=\"text-align:center;\">".$numService."</td>\n";
        echo "\t</tr>\n";
       
   }
}

#close database

?>
</table>