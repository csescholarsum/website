<?php


?>

<script type="text/javascript">

	$(function() {
		$( "#my_profile_tabs" ).tabs({
			ajaxOptions: {
				type: "POST",
				cache: true,
				success: function() {
					TabbedContent.slideContent($('#my_profile'));
				},
				error: function( xhr, status, index, anchor ) {
					$( anchor.hash ).html("Couldn't load this tab.");
				}
			}
		});

	});

</script>

<!--
	functions for get_event.php
-->
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
    $(".event_delete_button").live("click", function() {
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
    $(".view_event_row").live("click", function() {

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
	#my_profile_tabs .ui-tabs-nav {
		width: 100%;
		overflow: hidden;
		padding: 0px;
	}
</style>

<br />

<div id="my_profile_tabs">
	<ul>
		<li><a href="ajax/profile.php?USER_UNIQ=<?php echo $_SESSION['USER_UNIQ'];?>&type=<?php echo $_SESSION['type']; ?>">Profile</a></li>
		<li><a href="ajax/polls.php?USER_UNIQ=<?php echo $_SESSION['USER_UNIQ'];?>">Polls</a></li>
		<li><a href="ajax/event_logger.php">Event Logger</a></li>
	</ul>

</div>