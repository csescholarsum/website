
    <form action="db_update_attend.php<?php echo "?eventName=". $_GET['eventName'] ."&eventID=". $_GET['eventID'] ."&SerHours=". $_GET['SerHours']; ?>" method='post'>

      <table>
        <th> <?php echo $_GET['eventName'];?> Attendence (Service Hours: <?php echo $_GET['SerHours']; ?>)</th>
            <input type="hidden" name="eventID" value="<?php echo $_GET['eventID'];?>" />
        <tr>
          <td> Name </td>
          <td>
            <input type='text' name='name' />
          </td>

        </tr>

        <tr>
          <td> Uniqname </td>
          <td>
            <input type='text' name='uniqname' />
          </td>
        </tr>

      </table>
      <input type="submit" value="Record Attendence" />


    </form>

