<?php
  #establish a mysql connection
  #tbe is event table
  #tba is attendies table
  #db is the database
  include("../../tools/functions.php");
  
  $conn = connect_to_db_with_sqli();
 
  #get table
  $query = "SELECT name, uniqname FROM attendies WHERE eventID='". $_REQUEST['event_id'] ."' AND deleted=0 ORDER BY id DESC";
  $stmt = $conn->prepare($query);
  $stmt->execute();
  $stmt->bind_result(
    $attend_name,
    $attend_uniqname);

  if ($stmt->fetch())
  {
    echo "<table>
            <th>
              Name
            </th>
            <th>
              Uniqname
            </th>
            ";
            
    do
	  {
        echo "<tr>
                <td>
                  ". $attend_name ."
                </td>
                <td>
                  ". $attend_uniqname ." 
                </td>
              </tr>
              ";
    } while($stmt->fetch());
    echo "</table>";
    
  }
  else
  {
      echo "<p> No attendees posted. </p>";
  }

?>

