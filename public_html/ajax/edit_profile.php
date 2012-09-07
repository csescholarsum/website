<?php

include("../tools/functions.php");

connect_to_db();

$user = $_REQUEST['USER_UNIQ'];

$query = mysql_query("SELECT * FROM members WHERE uniqname = '$user' AND deleted=0 Limit 1");

$userData = mysql_fetch_row($query);

list($id, $deleted, $name, $uniqname, $gradMonth, $gradYear, $showResume, $hasResume, $major, $hidden, $gpa, $type) = $userData;

?>

<form class="updateUser" name="updateUser" enctype="multipart/form-data" action="ajax/action/save_profile.php" method="post" >
    <table>
	    <tr>
	    	<td>Name: </td>
	    	<td>
	    		<input name="name" type="text" value="<?php echo $name; ?>"  />
	    	</td>
	    </tr>
	    <tr>
	    	<td>Uniqname: </td>
	    	<td>
	    		<?php echo $uniqname; ?>
	    		<input type='hidden' name='uniqname' value="<?php echo $uniqname; ?>" />
	    	</td>
	    </tr>
	    <tr>
	    	<td>Major: </td>
	    	<td>
	        	<select name="major">
	            	<option value=""></option>
	            	<option value="EE" <?php if ($major == "EE") echo " selected=\"selected\""; ?>>EE</option>
	            	<option value="CSE"<?php if ($major == "CSE") echo " selected=\"selected\""; ?>>CSE</option>
	                <option value="CE"<?php if ($major == "CE") echo " selected=\"selected\""; ?>>CE</option>
	                <option value="CS-LSA"<?php if ($major == "CS-LSA") echo " selected=\"selected\""; ?>>CS_LSA</option>
	            </select>
	    	</td>
	    </tr>
    	<tr>
    		<td>Graduation: </td>
    		<td>
    			<input name="gradMonth" type="text" maxlength="2" size="3" value="<?php echo $gradMonth; ?>"  />, <input name="gradYear" type="text" maxlength="4" size="4" value="<?php echo $gradYear; ?>"  /> (mm yyyy)
    		</td>
    	</tr>
    	<tr>
    		<td>GPA: </td>
    		<td>
    			<input name="gpa" size="4" type="text" value="<?php PrintGPA($gpa); ?>" /> Your GPA will not be visible at this time.
    		</td>
    	</tr>
<?php
	if ($_REQUEST['type'] == "Admin") {
?>
    	<tr>
    		<td>Status: </td>
    		<td>
    			<select name="type">
    				<option value='Member' <?php if ($type == "Member") echo "selected" ?>>Member</option>
    				<option value='Admin' <?php if ($type == "Admin") echo "selected" ?>>Admin</option>
    				<option value='Alumni' <?php if ($type == "Alumni") echo "selected" ?>>Alumni</option>
    			</select>
    		</td>
    	</tr>
<?php
	}
	else {
?>
    	<tr>
    		<td colspan="2"><input type='hidden' name='type' value='<?php echo $type; ?>'></td>
    	</tr>		
<?php
	}
?>
    	<tr>
    		<td>Resume Visible: </td>
    		<td>
    			<input name="resumeVisible" type="checkbox" <?php if ($showResume) echo "checked=\"checked\""; ?>  />
    		</td>
    	</tr>
    	<tr>
    		<td>Resume: </td>
    		<td>
    			<?php
					if ($hasResume)
					{
						echo "\n<a target='_BLANK' href=\"resumes/".$uniqname.".pdf\">View Resume</a>\n";
					}
					else
					{
						echo "No resume";
					}
				?>
    		</td>
    	</tr>
    	<tr>
    		<td colspan='2'>
    			<input type="file" name="resumeFile"  /> (must be a pdf, will overwrite existing resume)<br />
    		</td>
    	</tr>
    </table>
</form>
<br />
<br />


<script type="text/javascript">

	$(function() {

		//Pretty up buttons
		$(".button").button();
	});
</script>