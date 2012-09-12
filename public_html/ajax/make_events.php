
      <table class='event_table'>
        <th> Event Maker </th>
        <tr>
          <td> Event Name </td>
          <td>
            <input type='text' class='title' />
          </td>

        </tr>

        <tr>
          <td> Date </td>
          <td>
            <input type='text' class='date' />
          </td>
        </tr>
        
        <tr>
          <td> Service Hours (if applicable) </td>
          <td>
            <input type='text' class='serhours' value='0'/>
          </td>
        </tr>

      </table>
      <input type="button" class="create_event_button" value="Create Event" />

<script type="text/javascript">

  $(function() {

    $(".date").datepicker();

    $(".create_event_button").click(function() {
      $.ajax({
        type: "POST",
        url: "ajax/action/add_event.php",
        data: { title : $(".event_table .title").val(), date : $(".event_table .date").val(), serhours : $(".event_table .uniqname").val()},
        success: function(text) {

          //Check if the process wasn't sucessful
          if (text.indexOf("success") == -1) {

            message_popup("", text, 1, "#");
          }
          else {

            //Reload Event Logger tab
            $("#my_profile_tabs").tabs('load', 2);

          }
        }
      });
    });

  });

</script>
