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
        <th>Resume</th>
		<th>Events Attended</th>
		<th>Service Hours</th>
<?php
$query = mysql_query("SELECT * FROM members WHERE (type='Member' OR type='Admin') AND deleted=0 ORDER BY member_name");

#checks if db doesn't open
if (mysql_num_rows($query) == 0)
{
?>
	<tr>
    	<td>-</td>
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
	
	#This indexes through the db to print member info
	
	while ($userData = mysql_fetch_row($query))
	{
		list($id, $deleted, $member_name, $uniqname, $gradMonth, $gradYear, $showResume, $hasResume, $major, $gpa, $type) = $userData;
		if ($member_name == "")
			$member_name = "No Name";
		$member_email = $uniqname."@umich.edu";
		if ($hasResume && $showResume)
		{
			$resumeLink = "./resumes/".$uniqname.".pdf";
			$resumeLink = "<a target='_BLANK' href=\"".$resumeLink."\">View Resume</a>";
		}
		else {
			$resumeLink = "-------";
		}
		
		#this grabs the event table and updates events and service hours
		$attend_tb = mysql_query("SELECT * FROM attendies WHERE Uniqname='".$uniqname."' AND deleted=0" );
		if(mysql_num_rows($attend_tb) != 0) {
		
			#get event number
			$numEvents = mysql_num_rows($attend_tb);
			
			#add up service hours
				#init
				$numService = 0;
				
				#add
			while($attend_data = mysql_fetch_row($attend_tb)) {
			
				#extract data from event table
				list($name, $uniqname, $eventID) = $attend_data;
				
				#query with event ID
				$event_tb = mysql_query("SELECT * FROM events WHERE eventID='".$eventID."' AND deleted=0" );
				
				if ($event_data = mysql_fetch_row($event_tb) ) {
					
					#extract data
					list($eventID, $title, $date, $serviceHours) = $event_data;
					
          #updates service hours and removes 1 event b/c it is counted as service
					$numService = $numService + $serviceHours;
          if ($serviceHours != 0) {
            $numEvents = $numEvents - 1;
          }
                    
				}
			}
		}
		else {
			$numEvents = "-";
			$numService = "-";
		}
    #fix to avoid having 0 service hours
    if ($numService == 0) {
      $numService = "-";
    }
		
		#printing info into table
		echo "\t<tr>\n";
		echo "\t\t<td>$member_name</td>\n";
		echo "\t\t<td>".$member_email."</td>\n";
		echo "\t\t<td>".$major."</td>\n";
		if (($gradMonth < 1)||($gradMonth > 12))
			echo "\t\t<td>&nbsp;</td>\n";
		else
			echo "\t\t<td>".$gradMonth."/".$gradYear."</td>\n";
		echo "</td>\n";
		echo "\t\t<td>".$resumeLink."</td>\n";
		echo "\t\t<td style=\"text-align:center;\">".$numEvents."</td>\n";
		echo "\t\t<td style=\"text-align:center;\">".$numService."</td>\n";
		echo "\t</tr>\n";
	}
}

#close database

?>
</table>