
    <form action='db_update_event.php' method='post'>

      <table>
        <th> Event Maker </th>
        <tr>
          <td> Event Name </td>
          <td>
            <input type='text' name='title' />
          </td>

        </tr>

        <tr>
          <td> Date </td>
          <td>
            <input type='text' name='date' />
          </td>
        </tr>
        
        <tr>
          <td> Service Hours (if applicable) </td>
          <td>
            <input type='text' name='serhours' value='0'/>
          </td>
        </tr>

      </table>
      <input type="submit" value="Create Event" />


    </form>

