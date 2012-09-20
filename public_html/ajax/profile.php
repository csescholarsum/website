<?php

	$_SESSION['USER_UNIQ'] = $_REQUEST['USER_UNIQ'];
	$_SESSION['type'] = $_REQUEST['type'];

	include("../includes/config.php");
	include("../tools/functions.php");

	$conn = connect_to_db_with_sqli();

	$query = "SELECT name, uniqname, gradMonth, gradYear, showResume, hasResume, major, gpa, type FROM members WHERE uniqname=? AND deleted=0 LIMIT 1";

	$stmt = $conn->prepare($query) or die("Unable to retrieve profile data.");

	$stmt->bind_param('s', $_SESSION['USER_UNIQ']);
	$stmt->execute();
	$stmt->bind_result( 
		$name, 
		$uniqname, 
		$gradMonth, 
		$gradYear, 
		$showResume, 
		$hasResume, 
		$major, 
		$gpa, 
		$type);
	$stmt->fetch();

	$stmt->close();

?>

<br />
<br />

<table>
	<tr>
		<td>
			Name:
		</td>
		<td>
<?php
		echo $name;
?>
		</td>
	</tr>
	<tr>
		<td>
			Uniqname:
		</td>
		<td>
<?php
		echo $uniqname;
?>
		</td>
	</tr>
	<tr>
		<td>
			Graduation Date:
		</td>
		<td>
<?php
		echo FormatGradDate( $gradMonth, $gradYear);
?>
		</td>
	</tr>
	<tr>
		<td>
			Major:
		</td>
		<td>
<?php
		echo $major;
?>
		</td>
	</tr>
	<tr>
		<td>
			GPA:
		</td>
		<td>
<?php
		echo $gpa;
?>
		</td>
	</tr>
	<tr>
		<td>
			Status:
		</td>
		<td>
<?php
		echo $type;
?>
		</td>
	</tr>
	<tr>
		<td>
			Resume:
		</td>
		<td>
<?php

	if ($hasResume) {

		//This file is included in public_html/index.php so we don't included ../
		echo "<a target='_BLANK' href='resumes/index.php?uniqname=$uniqname'> Resume </a>";
	}
	else {

		echo "No resume provided";
	}
?>
		</td>
	</tr>
	<tr>
		<td>
			Resume Privacy:
		</td>
		<td>
<?php 

	if ($showResume) {

		echo "Showing Resume";
	}
	else {

		echo "Resume Hidden";
	}
?>
		</td>
	</tr>
</table>
<br />
<input type='button' class='button edit_profile_button' value='Edit' />


<script type="text/javascript">

	$(function () {

		$(".button").button();
		
		$(".popup").dialog({
			autoOpen: false,
			modal: true,
			show: "fade",
			hide: "fade",
			width: "600px",
			buttons: {
				"Save Changes" : function() {
					$(".updateUser").submit();
				},
				/*
				"Delete Profile" : function() {
					$.ajax({
						type: "POST",
						url: "ajax/action/delete_profile.php",
						data: { USER_UNIQ : '<?php echo $_SESSION['USER_UNIQ']; ?>'},
						success: function() {

						});
					})
				},
				*/
				"Delete Resume" : function () {
					$.ajax({
						type: "POST",
						url: "ajax/action/delete_resume.php",
						data: { USER_UNIQ : '<?php echo $_SESSION['USER_UNIQ']; ?>'},
						success: function() {

							window.location.href = "index.php?slide_page=my_profile";
						}
					})
				},
				"Cancel" : function() {
					$(this).dialog('close');
				}
			}
		});

		$(".edit_profile_button").click(function() {

			$.ajax({
				type: "POST",
				url: "ajax/edit_profile.php",
				data: { USER_UNIQ : '<?php echo $_SESSION['USER_UNIQ']; ?>', type : '<?php echo $_SESSION['type']; ?>'},
				success: function(text) {

					$(".popup").dialog('open');
					$(".popup").html(text);
				}
			});
		});

/*
		$(".updateUser").live("submit", function() {
			$.ajax({
				type: "POST",
				url: "ajax/action/save_profile.php",
				data: $(".updateUser").serializeArray(),
				success: function(text) {

					message_popup("", text, 1, "#");

					$(".popup").dialog("close");
				}
			});

			//Returning false overrides the page reload.
			return false;
		});
*/


	});
</script>