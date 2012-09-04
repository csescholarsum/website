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
$query = mysql_query("SELECT * FROM attendies WHERE deleted=0 ORDER BY Uniqname");

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
    list($id, $deleted, $member_name, $uniqname, $eventID) = $userData;
		
    if ($uniqname != $old_uniqname) {
    
        #Check if the unique name has 1 or more rows and that it is not a member
        if ( 1 > mysql_num_rows(mysql_query("SELECT * FROM members WHERE uniqname='". $uniqname ."' AND deleted=0"))  && 1 <= mysql_num_rows( mysql_query("SELECT * FROM attendies WHERE Uniqname='". $uniqname ."'")) ) {
        
		        #this grabs the event table and updates events and service hours
		        $attend_tb = mysql_query("SELECT * FROM attendies WHERE uniqname='".$uniqname."' AND deleted=0" );
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
        				
				        #
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
            echo "\t\t<td>$uniqname</td>\n";
		        echo "\t\t<td style=\"text-align:center;\">".$numEvents."</td>\n";
		        echo "\t\t<td style=\"text-align:center;\">".$numService."</td>\n";
		        echo "\t</tr>\n";
	        }
       }
       
       
       $old_uniqname = $uniqname;
   }
}

#close database

?>
</table>