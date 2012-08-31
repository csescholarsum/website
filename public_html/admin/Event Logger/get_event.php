<?php
  #establish a mysql connection
  #tbe is event table
  #tba is attendies table
  #db is the database
  include("db_init.php");
  
  
  #this deletes events
  if (isset($_GET['delete']))
  {
	  $event_id = $_GET['delete'];
	  mysql_query("DELETE FROM events WHERE eventID = '$event_id' LIMIT 1");
  }
  
  
  echo "<br /><br />";
  
  #get table
  $query = mysql_query("SELECT * FROM ". $tbe);
  
  if (mysql_num_rows($query) == 0)
  {
      echo "<p> No events posted. </p>";
  }
  else
  {
    echo "<table>
            <th>&nbsp;</th>
            <th>
              Event Name
            </th>
            <th>
              Date
            </th>
            <th>
              Service Hours
            </th>
            ";
            
	  while ($userData = mysql_fetch_row($query))
	  {
        echo "<tr>
                <td>
                  <button onclick=\"if (confirm('Delete ". $userData[1] ."?')){window.location='./index.php?delete=$userData[0]';}\">X</button>
                </td>
                <td>
                  <a href='attend.php?eventName=". $userData[1] ."&eventID=". $userData[0] ."&SerHours=". $userData[3] ."' >". $userData[1] ."</a>
                </td>
                <td>
                  ". $userData[2] ." 
                </td>
                <td>
                  ". $userData[3] ."
                </td>
              </tr>
              ";
    }
    echo "</table>";
    
    
  }
  echo "<br /><br />";

?>

