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

<script type="text/javascript">

  $(function () {
    
    $(".popup").dialog({
      autoOpen: false,
      modal: true,
      show: "fade",
      hide: "fade",
      width: "600px",
      buttons: {
        "Close" : function() {
          $(this).dialog('close');
        }
      }
    });

    //Delete event on button press after confirm
    $(".event_delete_button").click(function() {
      $.ajax({
        type: "POST",
        url: "ajax/action/delete_event.php",
        data: { eventID : $(this).parent().parent().children().val() },
        success: function(text) {
          $("#my_profile_tabs").tabs('load', 2);
          $('.popup').dialog('close');
        }
      })
    });

    //Open popup on row click
    $(".view_event_row").click(function() {

      $('.popup').dialog('open');
      $('.popup').html("<p> \
    <form class='sign_in_form' method='post'> \
      <table> \
        <th> " + $(this).children().next(".event_title").html() + " Attendence (Service Hours: "+ $(this).children().next(".event_serhours").html() +")</th> \
            <input type='hidden' class='eventID' name='eventID' value='"+ $(this).children().val() +"' /> \
        <tr> \
          <td> Name </td> \
          <td> \
            <input type='text' name='name' /> \
          </td> \
        </tr> \
        <tr> \
          <td> Uniqname </td> \
          <td> \
            <input type='text' name='uniqname' /> \
          </td> \
        </tr> \
      </table> \
      <input type='submit' value='Record Attendence' /> \
    </form> \
        </p> \
        <div class='attendance_table'> \
        </div>");
      print_event_attendance($(this).children().val(), ".attendance_table");
    });

    $(".sign_in_form").unbind();

    $(".sign_in_form").live("submit", function() {
      $.ajax({
        type: "POST",
        url: "ajax/action/add_attendance.php",
        data: $(".sign_in_form").serializeArray(),
        success: function(text) {

          //Check if duplicate multiple process returning
          if (text == "") {
            return;
          }

          //Check if the process wasn't sucessful
          if (text.indexOf("success") == -1) {

            message_popup("", text, 1, "#");
          }
          else {
            print_event_attendance($(".sign_in_form .eventID").val(), ".attendance_table");

            //Clear input text fields
            $('.sign_in_form input[type=text]').each(function() {
              $(this).val("");
            })
          }
        }
      });

      //Returning false overrides the page reload.
      return false;
    });

  });

  function print_event_attendance( event_id, selector) {

    $.ajax({
      type: "POST",
      url: "ajax/action/print_event_attendance.php",
      data: { event_id : event_id},
      success: function(text) {

        $(selector).html(text);
      }
    });
  }

</script>

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