<?php
  #establish a mysql connection
  #tbe is event table
  #tba is attendies table
  #db is the database
  include("db_init.php");
  
  #this deletes attendees
  if (isset($_GET['delete']))
  {
	  $uniqname = $_GET['delete'];
	  mysql_query("DELETE FROM attendies WHERE Uniqname = '$uniqname' AND eventID='". $_GET['eventID'] ."' LIMIT 1");
  }
  
  
  echo "<br /><br />";
  
  #get table
  $query = mysql_query("SELECT * FROM ". $tba ." WHERE eventID='". $_GET['eventID'] ."'");
  
  if (mysql_num_rows($query) == 0)
  {
      echo "<p> No attendees posted. </p>";
  }
  else
  {
    echo "<table>
            <th>
              &nbsp;
            </th>
            <th>
              Name
            </th>
            <th>
              Uniqname
            </th>
            <th>
              eventID
            </th>
            ";
            
	  while ($userData = mysql_fetch_row($query))
	  {
        echo "<tr>
                <td>
                  <button onclick=\"if (confirm('Delete ". $userData[0] ."?')){window.location='./attend.php?delete=".$userData[1]."&eventName=". $_GET['eventName'] ."&eventID=". $_GET['eventID'] ."&SerHours=". $_GET['SerHours'] ."';}\">X</button>
                </td>
                <td>
                  ". $userData[0] ."
                </td>
                <td>
                  ". $userData[1] ." 
                </td>
                <td>
                  ". $userData[2] ."
                </td>
              </tr>
              ";
    }
    echo "</table>";
    
    
  }
  echo "<br /><br />";

?>

