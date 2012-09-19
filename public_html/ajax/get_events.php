<?php
  #establish a mysql connection
  #tbe is event table
  #tba is attendies table
  #db is the database
  include("../tools/functions.php");
  
  $conn = connect_to_db_with_sqli();
     
  #get table
  $query = "SELECT eventID, Title, Date, SerHours FROM events WHERE deleted=0";
  $stmt = $conn->prepare($query);
  $stmt->execute();
  $stmt->bind_result(
    $event_id,
    $event_title,
    $event_date,
    $event_serhours);

  //Check if row exists
  if ($stmt->fetch())
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
            
	  do 
    {
        echo "<tr class='view_event_row'>
                <input type='hidden' value='$event_id'>
                <td>
                  <button class='event_delete_button'>X</button>
                </td>
                <td class='event_title'>
                  ". $event_title ."
                </td>
                <td>
                  ". $event_date ." 
                </td>
                <td class='event_serhours'>
                  ". $event_serhours ."
                </td>
              </tr>
              ";
    } while ($stmt->fetch());

    echo "</table>";
    
    $stmt->close();

  }
  else
  {
      echo "<p> No events posted. </p>";
  }

?>

<style type="text/css">

  .view_event_row:hover {

    cursor: pointer;
    background-color: #E0E0EF;
  }

  .view_event_row:active {

    cursor: pointer;
    background-color: #D0D0DF;
  }

</style>